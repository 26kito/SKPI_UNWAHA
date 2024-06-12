<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $usn = $request->username;
        $password = $request->password;
    }

    public function registerView()
    {
        return view('register');
    }
}
