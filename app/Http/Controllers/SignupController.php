<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function signup() {
        return view('app.signup');
    }

    public function complete() {
        $data = request()->validate([
            'has' => 'required',
            'wants.*' => '',
            'contact_info' => 'required'
        ]);

        $user = Auth::user();
        $user->has = $data['has'];
        $user->contact_info = $data['contact_info'];
        $user->wants = implode(',', array_keys($data['wants']));
        $user->save();

        flash()->success('Signup complete. Welcome to ' . config('app.name') . '!');
        return redirect()->to(route('app.main'));
    }
}
