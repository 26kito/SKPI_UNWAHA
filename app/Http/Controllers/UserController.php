<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        $user = DB::table('user')->where('USERNAME', $usn)->first();

        if (!$user || !Hash::check($password, $user->PASSWORD)) {
            return redirect()->back()->with('message', 'Username atau password salah!');
        }

        $encryptedUserID = encrypt($user->ID);
        Session::put('isLogin', $encryptedUserID);
        Session::put('user', $user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        if (Session::has('isLogin')) {
            Session::forget('isLogin');
        }
    }

    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'prodi' => 'required',
                'namaMhs' => 'required',
                'nim' => 'required',
                'nik' => 'required',
                'namaIbuKandung' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'fotoMahasiswa' => 'file|size:4000',
            ],
            [
                'prodi.required' => 'Prodi belum diisi!',
                'namaMhs.required' => 'Nama mahasiswa belum diisi!',
                'nim.required' => 'NIM mahasiswa belum diisi!',
                'nik.required' => 'Nomor KTP belum diisi!',
                'namaIbuKandung.required' => 'Nama ibu kandung belum diisi!',
            ]
        );
    }
}
