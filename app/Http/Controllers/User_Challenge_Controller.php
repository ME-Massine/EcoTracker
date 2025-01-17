<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\User_Challenges;
use Illuminate\Http\Request;

use App\Models\Challenges;

use function Laravel\Prompts\alert;

class User_Challenge_Controller extends Controller
{
    public function registerPage()
    {
        return view("Register");  // affichage de la page Register
    }
    public function Register(Request $req)
    {
        $var = $req->validate([
            'name' => 'required|string|max:255', // required pour verifier si le champ est vide
            'email' => 'required|email|unique:users', // unique:users pour verifier si l'email existe deja
            'password' => 'required|min:6', // min:6 pour verifier si le mot de passe contient au moins 6 caracteres
        ]);

        Users::create($var); // creation d'un nouvel utilisateur

        return redirect("/Login"); // redirection vers la page de connexion
    }

    public function loginPage()
    {
        return view("Login"); // affichage de la page de connexion
    }

    public function Login(Request $req)
    {
        $User = Users::all();

        $email = $req->input('email'); // recuperation de l'email et du mot de passe
        $inputpassword = $req->input('password');

        foreach ($User as $user) {
            if ($user->email == $email) {
                if ($user->password == $inputpassword) {
                    $req->session()->put('id_conn', $user->id); // creation d'une session pour l'utilisateur connecté.
                    return redirect("/Home"); // redirection vers la page d'accueil.
                } else
                    return view("/Login", ["error" => "Password is incorrect"]);
            }
        }

        return view("/Login", ["error" => "Email is incorrect"]);
        // affichage d'un message d'erreur si le mot de passe est incorrect ou si l'email n'existe pas.
    }

    public function homePage()
    {
        return view("Home"); // affichage de la page d'accueil
    }
    public function Points(Request $req)
    {
        $Challenges_id = []; // initialisation du tableau des challenges
        $points = 0;              // initialisation des points à 0
        $id_conn = $req->session()->get('id_conn'); // recuperation de l'id de l'utilisateur connecté

        $User_challenge = User_Challenges::all();
        foreach ($User_challenge as $user_challenge) {
            if ($user_challenge->user_id == $id_conn) {
                $Challenges_id[] = $user_challenge; // recuperation des challenges de l'utilisateur connecté
            }
        }

        $Challenge = Challenges::all(); // recuperation de tous les challenges


        foreach ($Challenges_id as $Ch_id) {
            foreach ($Challenge as $challenge) {
                if ($challenge->id == $Ch_id->challenge_id && $Ch_id->status == 1) {
                    $points += $challenge->points; // calcul des points de l'utilisateur connecté
                }
            }
        }

        $Users = Users::all(); // recuperation de tous les utilisateurs

        foreach ($Users as $user) {
            if ($user->id == $id_conn) {
                $user->points = $points; // mise à jour des points de l'utilisateur connecté
                $user->save(); // sauvegarde des points
                break;
            }
        }

        return view("Home", compact('points'));
        // affichage de la page d'accueil avec les points de l'utilisateur connecté
    }
    public function challengePage()
    {
        $challenges = Challenges::all(); // recuperation de tous les challenges
        return view("Challenge", ['challenges' => $challenges]); // affichage de la page des challenges
    }

    public function addChallenge(Request $req)
    {
        $id_conn = $req->session()->get('id_conn'); // recuperation de l'id de l'utilisateur connecté

        $selectedChallenges = $req->input('challenges', []); // recuperation des challenges selectionnés

        if (sizeof($selectedChallenges) == 0) {
            return redirect("/Challenges"); // redirection vers la page des challenges
        }

        foreach ($selectedChallenges as $challenge_id) {
            $existe = false;
            $userChallenges = User_Challenges::all();
            // recuperation de tous les challenges de l'utilisateur connecté
            foreach ($userChallenges as $user_challenge) {
                if ($user_challenge->user_id == $id_conn && $user_challenge->challenge_id == $challenge_id && $user_challenge->status == 0) {
                    $existe = true;
                    // verification si le challenge selectionné existe deja
                    break;
                }
            }
            if ($existe) {
                continue;
            }

            User_Challenges::create([ // creation d'un nouveau challenge
                'user_id' => $id_conn,
                'challenge_id' => $challenge_id,
            ]);
        }

        return redirect("/Progres"); // redirection vers la page de progression
    }


    public function progresPage(Request $req)
    {
        $Challenges_id = [];

        $id_conn = $req->session()->get('id_conn');

        if (!$id_conn) {
            return redirect("/Login")->with('error', 'User not logged in');
        }

        $User_challenge = User_Challenges::all();
        foreach ($User_challenge as $user_challenge) {
            if ($user_challenge->user_id == $id_conn) {
                $Challenges_id[] = $user_challenge; // recuperation des challenges de l'utilisateur connecté
            }
        }


        $User_c = [];

        $Challenge = Challenges::all(); // recuperation de tous les challenges

        if (!isset($Challenges_id))
            return view("Progres", compact('User_c')); // affichage de la page de progression



        foreach ($Challenges_id as $Ch_id) {
            foreach ($Challenge as $challenge) {
                if ($challenge->id == $Ch_id->challenge_id) {
                    if ($Ch_id->status == 1) {
                        $Ch_id->status = "Terminé"; // verification si le challenge est terminé
                    } else {
                        $Ch_id->status = "En Progres"; // verification si le challenge est en cours
                    }
                    $User_c[] = [ // recuperation des challenges de l'utilisateur connecté
                        'challenge' => $challenge,
                        'status' => $Ch_id->status
                    ];
                }
            }
        }

        return view("Progres", compact('User_c')); // affichage de la page de progression
    }

    public function progresTermine(Request $req)
    {
        $id_conn = $req->session()->get('id_conn'); // recuperation de l'id de l'utilisateur connecté

        $selectedChallenges = $req->input('termine', []); // recuperation des challenges terminés

        if (sizeof($selectedChallenges) == 0)
            return redirect("/Progres"); // redirection vers la page de progression si aucun challenge n'est terminé

        $userChallenges = User_Challenges::all();

        foreach ($selectedChallenges as $challenge_id) {
            foreach ($userChallenges as $user_challenge) {
                if ($user_challenge->user_id == $id_conn && $user_challenge->challenge_id == $challenge_id && $user_challenge->status == 0) {
                    $user_challenge->status = true; // verification si le challenge est terminé
                    $user_challenge->save(); // sauvegarde du challenge
                    break;
                }
            }
        }

        return redirect(to: "/Progres");
    }

    public function classementPage()
    {
        $Users = Users::all();
        $Users = $Users->sortByDesc('points');
        // recuperation de tous les utilisateurs et tri par ordre decroissant des points

        $userChallenges = User_Challenges::all(); // recuperation de tous les challenges
        $classement = [];

        foreach ($Users as $user) {
            $compteur = 0;

            foreach ($userChallenges as $user_challenge) {
                if ($user_challenge->user_id == $user->id && $user_challenge->status == 1) {
                    $compteur++; // comptage des challenges terminés
                }
            }
            $classement[] = [ // recuperation du classement
                'User' => $user,
                'Nombre' => $compteur
            ];
        }

        return view("Classement", compact('classement')); // affichage de la page de classement
    }
}
