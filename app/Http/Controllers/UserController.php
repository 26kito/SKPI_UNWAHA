<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function loginView()
    {
        if (Session::has('isLogin')) {
            return back();
        }

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

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        if (Session::has('isLogin')) {
            Session::forget('isLogin');
        }
    }

    public function registerView()
    {
        if (Session::has('isLogin')) {
            return back();
        }

        return view('register');
    }

    public function register(Request $request)
    {
        $this->registerValidation($request);

        try {
            DB::transaction(function () use ($request) {
                $nama = $request->namaMhs;
                $nim = $request->nim;
                $prodi = $request->prodi;
                $nik = $request->nik;
                $namaIbuKandung = $request->namaIbuKandung;
                $tempatLahir = $request->tempatLahir;
                $tglLahir = $request->tglLahir;
                $tglMasuk = $request->tglMasuk;
                $gelarMahasiswa = $request->gelarMahasiswa;
                $email = $request->email;
                $password = Hash::make($request->password);

                $file = $request->file('fotoMahasiswa');
                $fileName = $request->hasFile('fotoMahasiswa') ? $file->getClientOriginalName() : null;

                if (!$file) {
                    throw new Exception('Silahkan upload foto mahasiswa terlebih dahulu!');
                }

                DB::table('user')->insert([
                    'USERNAME' => $nim,
                    'NAME' => strtoupper($nama),
                    'PASSWORD' => $password,
                    'ROLE' => 'MAHASISWA',
                ]);

                DB::table('mahasiswa')->insert([
                    'NAMA' => strtoupper($nama),
                    'NIM' => $nim,
                    'GELAR' => strtoupper($gelarMahasiswa),
                    'PRODI' => strtoupper($prodi),
                    'NIK' => $nik,
                    'NAMA_IBU_KANDUNG' => strtoupper($namaIbuKandung),
                    'TEMPAT_LAHIR' => strtoupper($tempatLahir),
                    'TANGGAL_LAHIR' => $tglLahir,
                    'TANGGAL_MASUK' => $tglMasuk,
                    'FOTO' => $fileName,
                    'EMAIL' => $email,
                    'PASSWORD' => $password
                ]);

                Storage::disk('public')->putFileAs('profiles', $file, $fileName);
            });

            return redirect()->route('login')->with(['status' => 'ok', 'message', 'Berhasil!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => 'not ok', 'message' => $e->getMessage()])->withInput();
        }
    }

    private function registerValidation($input)
    {
        $input->validate(
            [
                'prodi' => 'required',
                'namaMhs' => 'required',
                'nim' => ['required', Rule::unique('mahasiswa', 'NIM')->ignore($input->nim), Rule::unique('user', 'USERNAME')->ignore($input->nim)],
                'nik' => 'required',
                'namaIbuKandung' => 'required',
                'email' => ['required', Rule::unique('mahasiswa', 'EMAIL')->ignore($input->email)],
                'password' => 'required',
                'fotoMahasiswa' => [
                    'image', File::image()
                        ->max('3mb')
                ],
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
