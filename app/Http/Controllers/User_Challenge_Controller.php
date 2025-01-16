<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\User_Challenges;
use Illuminate\Http\Request;

use App\Models\Challenges;
use Illuminate\Foundation\Auth\User;

use function Laravel\Prompts\alert;

class User_Challenge_Controller extends Controller
{
    public function registerPage()
    {
        return view("Register");
    }
    public function Register(Request $req)
    {
        $var = $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        Users::create($var);

        return redirect("/Login");
    }

    public function loginPage()
    {
        return view("Login");
    }

    public function Login(Request $req)
    {
        $User = Users::all();

        $email = $req->input('email');
        $inputpassword = $req->input('password');

        foreach ($User as $user) {
            if ($user->email == $email) {
                if ($user->password == $inputpassword) {
                    $req->session()->put('id_conn', $user->id);
                    return redirect("/Home");
                } else
                    return view("/Login", ["error" => "Password is incorrect"]);
            }
        }

        return view("/Login", ["error" => "Email is incorrect"]);
    }

    public function homePage()
    {
        return view("Home");
    }
    public function Points(Request $req)
    {
        $Challenges_id = [];
        $points = 0;
        $id_conn = $req->session()->get('id_conn');

        $User_challenge = User_Challenges::all();
        foreach ($User_challenge as $user_challenge) {
            if ($user_challenge->user_id == $id_conn) {
                $Challenges_id[] = $user_challenge;
            }
        }

        $Challenge = Challenges::all();


        foreach ($Challenges_id as $Ch_id) {
            foreach ($Challenge as $challenge) {
                if ($challenge->id == $Ch_id->challenge_id && $Ch_id->status == 1) {
                    $points += $challenge->points;
                }
            }
        }

        $Users = Users::all();

        foreach ($Users as $user) {
            if ($user->id == $id_conn) {
                $user->points = $points;
                $user->save();
                break;
            }
        }

        return view("Home", compact('points'));
    }
    public function challengePage()
    {
        $challenges = Challenges::all();
        return view("Challenge", ['challenges' => $challenges]);
    }

    public function addChallenge(Request $req)
    {
        $id_conn = $req->session()->get('id_conn');

        $selectedChallenges = $req->input('challenges', []);

        if (sizeof($selectedChallenges) == 0) {
            return redirect("/Challenges");
        }

        foreach ($selectedChallenges as $challenge_id) {
            $existe = false;
            $userChallenges = User_Challenges::all();
            foreach ($userChallenges as $user_challenge) {
                if ($user_challenge->user_id == $id_conn && $user_challenge->challenge_id == $challenge_id && $user_challenge->status == 0) {
                    $existe = true;
                    break;
                }
            }
            if ($existe) {
                continue;
            }

            User_Challenges::create([
                'user_id' => $id_conn,
                'challenge_id' => $challenge_id,
            ]);
        }

        return redirect("/Progres");
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
                $Challenges_id[] = $user_challenge;
            }
        }


        $User_c = [];

        $Challenge = Challenges::all();

        if (!isset($Challenges_id))
            return view("Progres", compact('User_c'));



        foreach ($Challenges_id as $Ch_id) {
            foreach ($Challenge as $challenge) {
                if ($challenge->id == $Ch_id->challenge_id) {
                    if ($Ch_id->status == 1) {
                        $Ch_id->status = "Terminé";
                    } else {
                        $Ch_id->status = "En Progres";
                    }
                    $User_c[] = [
                        'challenge' => $challenge,
                        'status' => $Ch_id->status
                    ];
                }
            }
        }

        return view("Progres", compact('User_c'));
    }

    public function progresTermine(Request $req)
    {
        $id_conn = $req->session()->get('id_conn');

        $selectedChallenges = $req->input('termine', []);

        if (sizeof($selectedChallenges) == 0)
            return redirect("/Progres");

        $userChallenges = User_Challenges::all();

        foreach ($selectedChallenges as $challenge_id) {
            foreach ($userChallenges as $user_challenge) {
                if ($user_challenge->user_id == $id_conn && $user_challenge->challenge_id == $challenge_id && $user_challenge->status == 0) {
                    $user_challenge->status = true;
                    $user_challenge->save();
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

        $userChallenges = User_Challenges::all();
        $classement = [];

        foreach ($Users as $user) {
            $compteur = 0;

            foreach ($userChallenges as $user_challenge) {
                if ($user_challenge->user_id == $user->id && $user_challenge->status == 1) {
                    $compteur++;
                }
            }
            $classement[] = [
                'User' => $user,
                'Nombre' => $compteur
            ];
        }

        return view("Classement", compact('classement'));
    }
}
