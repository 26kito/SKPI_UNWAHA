<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SkpiController extends Controller
{
    public function view()
    {
        $data = DB::table('kategori_portofolio')->get();

        return view('input-skpi')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $userID = User::authUser()->ID;
        $kategoriPortoID = $request->kategoriPorto;
        $namaPorto = $request->namaPorto;
        $kesesuaianPorto = $request->kesesuaianPorto;
        $tglPorto = $request->tglPorto;
        $noDokumenPorto = $request->noDokumenPorto;
        $file = $request->file('fileDokumen');
        $fileName = $request->hasFile('fileDokumen') ? $request->file('fileDokumen')->getClientOriginalName() : null;

        $this->insertValidation($request);

        try {
            if (!$file) {
                throw new Exception('Silahkan upload dokumen terlebih dahulu!');
            }

            DB::table('skpi')->insert([
                'USER_ID' => $userID,
                'KATEGORI_PORTOFOLIO_ID' => $kategoriPortoID,
                'NAMA' => $namaPorto,
                'IS_SESUAI' => $kesesuaianPorto,
                'TANGGAL_PORTOFOLIO' => $tglPorto,
                'NO_DOKUMEN' => $noDokumenPorto,
                'NAMA_FILE' => $fileName,
            ]);

            Storage::disk('public')->putFileAs('documents', $file, $fileName);

            return redirect()->back()->with('message', 'Berhasil input portofolio!');
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => 'not ok', 'message' => $e->getMessage()]);
        }
    }

    private function insertValidation($input)
    {
        $input->validate(
            [
                'kategoriPorto' => 'required',
                'namaPorto' => 'required',
                'kesesuaianPorto' => 'required',
                'tglPorto' => 'required',
                'noDokumenPorto' => 'required',
            ],
            [
                'kategoriPorto.required' => 'Kategori portofolio belum diisi!',
                'namaPorto.required' => 'Nama portofolio belum diisi!',
                'kesesuaianPorto.required' => 'Kesesuaian portofolio belum diisi!',
                'tglPorto.required' => 'Tanggal portofolio belum diisi!',
                'noDokumenPorto.required' => 'Nomor dokumen portofolio belum diisi!',
            ]
        );
    }
}
