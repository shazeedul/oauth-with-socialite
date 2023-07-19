<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class Test1Controller extends Controller
{
    public function signInwithTest1()
    {
        return Socialite::driver('test_auth')->redirect();
    }

    public function callbackToTest1()
    {
        try {

            $user = Socialite::driver('test_auth')->user();

            dd($user);

            $finduser = User::where('auth_id', $user->id)->first();



        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
