<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

/**
 * Models
 * */

use App\Models\User;

class UsersController extends Controller
{

    /**
     * login
     *
     * @param  Request $request
     * @return void
     */
    public function login(Request $request, User $user)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!(Auth::attempt($credentials))) {
                return redirect('/')->with('error', trans("Messages.InvalidCredentials"));
            }
            return redirect('dashboard');
        } catch (Exception $ex) {
            return view('exceptions', compact('ex'));
        }
    }

    public function dashboard()
    {
        try {
            return view('pages/dashboard');
        } catch (Exception $ex) {
            return view('exceptions', compact('ex'));
        }
    }

    public function usersList()
    {
        try {
            return view('users/list');
        } catch (Exception $ex) {
            return view('exceptions', compact('ex'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}