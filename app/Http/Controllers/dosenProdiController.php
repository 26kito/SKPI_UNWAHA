<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class dosenProdiController extends Controller
{
    public function listMahasiswa()
    {
        return view('list-mahasiswa');
    }

    public function getDataMahasiswa()
    {
        $data = DB::table('mahasiswa')
            ->select('*')
            ->get();

        foreach ($data as $row) {
            $row->NAMA = ucwords(strtolower($row->NAMA));
            $row->TempatTglLahir = $row->TEMPAT_LAHIR . ', ' . $row->TANGGAL_LAHIR;
        }

        return $data;
    }

    public function updateStatusMahasiswa(Request $request)
    {
        $nim = $request->nim;
        $status = $request->status == 1 ? 0 : 1;

        DB::table('mahasiswa')->where('NIM', $nim)->update(['STATUS' => $status]);

        return response()->json(['status' => 'ok', 'message' => 'Berhasil update status mahasiswa!']);
    }

    public function addMahasiswaView()
    {
        return view('register-mahasiswa');
    }

    public function addMahasiswaBulkView()
    {
        return view('register-mahasiswa-bulk');
    }
}
