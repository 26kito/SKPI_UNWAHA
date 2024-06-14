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
}
