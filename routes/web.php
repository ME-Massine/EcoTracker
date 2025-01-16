<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User_Challenge_Controller;

Route::redirect('/', '/Login');
Route::get("/Register", [User_Challenge_Controller::class, "registerPage"]);
Route::post("/Register", [User_Challenge_Controller::class, "Register"]);

Route::get("/Login", [User_Challenge_Controller::class, "loginPage"]);
Route::post("/Login", [User_Challenge_Controller::class, "Login"]);

Route::get("/Home", [User_Challenge_Controller::class, "homePage"]);
Route::get("/Home", [User_Challenge_Controller::class, "Points"]);
Route::get("/Challenges", [User_Challenge_Controller::class, "challengePage"]);
Route::post("/Challenges", [User_Challenge_Controller::class, "addChallenge"])->name("addChallenges");
Route::get("/Progres", [User_Challenge_Controller::class, "progresPage"]);
Route::post("/Progres", [User_Challenge_Controller::class, "progresTermine"])->name("progresTermine");
Route::get("/Classement", [User_Challenge_Controller::class, "classementPage"]);
