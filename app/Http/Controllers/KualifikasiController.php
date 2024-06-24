<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KualifikasiController extends Controller
{
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

    public function editKualifikasiView($id)
    {
        $data = DB::table('kualifikasi')->where('ID', $id)->first();

        return view('edit-kualifikasi')->with(['data' => $data]);
    }

    public function updateKualifikasi(Request $request, $id)
    {
        $prodi = strtoupper($request->prodi);
        $judul = $request->judulKualifikasi;
        $penjelasanKualifikasi = $request->penjelasanKualifikasi;
        $subPenjelasan = $request->subPenjelasan;

        DB::table('kualifikasi')
            ->where('ID', $id)
            ->update([
                'PRODI' => $prodi,
                'JUDUL_KUALIFIKASI' => $judul,
                'PENJELASAN_KUALIFIKASI' => $penjelasanKualifikasi,
                'SUB_PENJELASAN' => $subPenjelasan
            ]);

        return redirect()->back()->with(['status' => 'ok', 'message' => 'Berhasil update data!']);
    }

    public function deleteKualifikasi(Request $request)
    {
        $id = $request->id;

        DB::table('kualifikasi')->where('ID', $id)->delete();

        return response()->json(['status' => 'ok', 'message' => 'Berhasil hapus kualifikasi!']);
    }
}
