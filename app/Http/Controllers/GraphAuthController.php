<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GraphAuthController extends Controller
{
    public function login() {
        return Socialite::with('graph')->stateless()->redirect();
    }

    public function redirect() {
        $graphUser = Socialite::with('graph')->stateless()->user();
        $user = User::where('graph_id', $graphUser->id)->first();
        if ($user === null) {
            $user = new User([
                'email' => $graphUser->email,
                'name' => $graphUser->givenName . ' ' . $graphUser->surname,
            ]);
            // For some idiotic reason this has to be on a separate line - laravel pls
            $user->graph_id = $graphUser->id;
            $user->initials = $graphUser->givenName . ' ' . substr($graphUser->surname, 0, 1) . '.';
            $user->save();
        }
        Auth::login($user, true);

        if (empty($user->has)) {
            return redirect()->to(route('app.signup'));
        } else {
            return redirect()->to(route('app.main'));
        }
    }
}
