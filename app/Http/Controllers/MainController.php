<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    function main() {
        $user = Auth::user();
        $data = User::canChangeWith(request()->user())->get();

        return view('app.main', ['data' => $data]);
    }

    function notifications() {
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return view('app.notifications');
    }
}
