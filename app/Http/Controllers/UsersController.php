<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    //
    public function index(Request $request): Response
    {
        //read access_log file from /opt/homebrew/var/log/access_log.log

        $users = User::all();

        //get roles and permissions
        foreach ($users as $user) {
//            $user->roles = $user->getRoleNames();
            $user->role = $user->getRoleNames()[0];
//            $user->permissions = $user->getPermissionsViaRoles();
        }

        return Inertia::render('Users/Index', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'users' => $users,
        ]);
    }
}
