<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Imports\MahasiswaImport;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        $validate = Validator::make($request->only(['username', 'password', 'captcha']), [
            'username' => 'required',
            'password' => 'required',
            'captcha' => (($request->has('captcha')) ? 'required|captcha' : ''),
        ], [
            'captcha.captcha' => 'Invalid captcha!'
        ]);

        try {
            if ($validate->fails()) {
                throw new Exception($validate->errors()->first());
            }

            $user = DB::table('user')->where('USERNAME', $usn)->first();

            if (!$user || !Hash::check($password, $user->PASSWORD)) {
                throw new Exception('Username atau password salah!');
            }

            $encryptedUserID = encrypt($user->ID);
            Session::put('isLogin', $encryptedUserID);
            Session::put('user', $user);

            return redirect()->intended(route('home'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()])->withErrors($e->getMessage())->withInput();
        }
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
        $from = explode('8000', $request->server('HTTP_REFERER'))[1];

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
                $tglLulus = $request->tglLulus;
                $noIjazah = $request->noIjazah;
                $gelarMahasiswa = $request->gelarMahasiswa;
                $email = $request->email;
                $password = Hash::make($request->password);

                $file = $request->file('fotoMahasiswa');
                $fileName = $file ? $nim . '_' . strtoupper($nama) . '.' . $file->getClientOriginalExtension() : null;

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
                    'TANGGAL_LULUS' => $tglLulus,
                    'NO_IJAZAH' => $noIjazah,
                    'FOTO' => $fileName,
                    'EMAIL' => $email,
                ]);

                Storage::disk('public')->putFileAs('profiles', $file, $fileName);
            });

            if (strpos($from, 'register')) {
                return redirect()->route('login')->with(['status' => 'ok', 'message' => 'Berhasil!']);
            } else {
                return redirect()->back()->with(['status' => 'ok', 'message' => 'Berhasil!']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => 'not ok', 'message' => $e->getMessage()])->withInput();
        }
    }

    private function registerValidation($input)
    {
        $input->validate(
            [
                'prodi' => 'required',
                'namaMhs' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'nim' => ['required', 'numeric', Rule::unique('mahasiswa', 'NIM')->ignore($input->nim), Rule::unique('user', 'USERNAME')->ignore($input->nim)],
                'nik' => ['required', 'numeric', Rule::unique('mahasiswa', 'NIK')->ignore($input->nik)],
                'namaIbuKandung' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'email' => ['required', 'email:rfc,dns', Rule::unique('mahasiswa', 'EMAIL')->ignore($input->email)],
                'password' => 'required|min:8',
                'fotoMahasiswa' => [
                    'image', File::image()
                        ->max('3mb')
                ],
            ],
            [
                'prodi.required' => 'Prodi belum diisi!',
                'namaMhs.required' => 'Nama mahasiswa belum diisi!',
                'namaMhs.regex' => 'Nama mahasiswa hanya bisa diisi dengan huruf!',
                'nim.required' => 'NIM mahasiswa belum diisi!',
                'nim.numeric' => 'Format NIM salah!',
                'nik.required' => 'Nomor KTP belum diisi!',
                'nik.numeric' => 'Format No. KTP salah!',
                'namaIbuKandung.required' => 'Nama ibu kandung belum diisi!',
                'namaIbuKandung.regex' => 'Nama ibu kandung hanya bisa diisi dengan huruf!',
                'email.required' => 'Email belum diisi!',
                'password.required' => 'Password belum diisi!',
                'password.min' => 'Password minimal 8 karakter!',
            ]
        );
    }

    public function editPassView()
    {
        $user = User::authUser();

        return view('edit-profile')->with('user', $user);
    }

    public function updatePass(Request $request)
    {
        $user = User::authUser();
        $oldPass = $request->oldPass;
        $newPass = $request->newPass;
        $newPassConfirm = $request->newPassConfirm;

        try {
            if (!Hash::check($oldPass, $user->PASSWORD)) {
                throw new Exception('Password salah!');
            }

            if ($newPass !== $newPassConfirm) {
                throw new Exception('Password baru dan konfirmasi password tidak sama!');
            }

            DB::table('user')->where('USERNAME', $user->USERNAME)->update(['PASSWORD' => Hash::make($newPass)]);

            return redirect()->back()->with(['status' => 'ok', 'message' => 'Berhasil ubah password']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => 'not ok', 'message' => $e->getMessage()])->withInput();
        }
    }

    public function registerBulk(Request $request)
    {
        $file = $request->file('fileInsertMhsBulk');

        Excel::import(new MahasiswaImport, $file);

        return redirect()->back()->with(['status' => 'ok', 'message' => 'Berhasil!']);
    }
}
