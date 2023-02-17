<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        //get roles
        $roles = Role::all();

        //if current user is not admin , need remove role admin from $roles
        if (!Auth::user()->hasRole('Admin')) {
            $roles = Role::get()->except(1);
        }

        //get current role user
        $currentRole = $request->user()->getRoleNames();

        //if user has no role, assign role user
        if (count($currentRole) == 0) {
            $request->user()->assignRole('Editor');
            $currentRole = $request->user()->getRoleNames();
        }

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'roles' => $roles,
            'currentRole' => $currentRole[0]    ,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }


        //update role user
        $request->user()->syncRoles($request->role);

        $role = Role::findByName($request->role);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $request->user()->assignRole([$role->id]);

        //save user

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
