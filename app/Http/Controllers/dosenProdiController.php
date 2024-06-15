<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function listKualifikasi()
    {
        return view('list-kualifikasi');
    }

    public function addKualifikasiView()
    {
        return view('insert-kualifikasi');
    }

    public function insertKualifikasi(Request $request)
    {
        $prodi = strtoupper($request->prodi);
        $judul = $request->judulKualifikasi;
        $penjelasanKualifikasi = $request->penjelasanKualifikasi;
        $subPenjelasan = $request->subPenjelasan;

        DB::table('kualifikasi')
            ->insert([
                'PRODI' => $prodi,
                'JUDUL_KUALIFIKASI' => $judul,
                'PENJELASAN_KUALIFIKASI' => $penjelasanKualifikasi,
                'SUB_PENJELASAN' => $subPenjelasan
            ]);

        return redirect()->back()->with(['status' => 'ok', 'message' => 'Berhasil!']);
    }

    public function getDataKualifikasi()
    {
        $data = DB::table('kualifikasi')->get();

        return $data;
    }

    public function listPortofolio()
    {
        return view('list-portofolio');
    }
}
