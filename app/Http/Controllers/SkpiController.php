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
        $fileName = $file ? $userID . '_' . $kategoriPortoID . '_' . str_replace(' ', '', $file->getClientOriginalName()) : null;

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

    public function getAllSKPI()
    {
        $data = DB::table('skpi')
            ->join('kategori_portofolio AS kp', 'skpi.KATEGORI_PORTOFOLIO_ID', 'kp.ID')
            ->join('status_skpi AS ss', 'skpi.STATUS_ID', 'ss.ID')
            ->join('mahasiswa AS mhs', 'skpi.USER_ID', 'mhs.ID')
            ->select(
                'mhs.NAMA AS NAMA_MAHASISWA',
                'kp.KATEGORI AS KATEGORI_PORTOFOLIO',
                'skpi.NAMA AS NAMA_PORTOFOLIO',
                'skpi.IS_SESUAI',
                'skpi.TANGGAL_PORTOFOLIO',
                'skpi.NO_DOKUMEN',
                'skpi.STATUS_ID',
                'ss.STATUS',
                'skpi.NAMA_FILE',
                DB::raw("CASE
                            WHEN STATUS_ID = 1 THEN 'text-primary'
                            WHEN STATUS_ID = 2 THEN 'text-success'
                            ELSE 'text-danger'
                        END AS status_text")
            )
            ->get();

        return $data;
    }

    public function getSKPI()
    {
        $userID = User::authUser()->ID;

        $data = DB::table('skpi')
            ->join('kategori_portofolio AS kp', 'skpi.KATEGORI_PORTOFOLIO_ID', 'kp.ID')
            ->join('status_skpi AS ss', 'skpi.STATUS_ID', 'ss.ID')
            ->where('skpi.USER_ID', $userID)
            ->select(
                'kp.KATEGORI AS KATEGORI_PORTOFOLIO',
                'skpi.NAMA AS NAMA_PORTOFOLIO',
                'skpi.IS_SESUAI',
                'skpi.TANGGAL_PORTOFOLIO',
                'skpi.NO_DOKUMEN',
                'skpi.STATUS_ID',
                'ss.STATUS',
                'skpi.NAMA_FILE',
                DB::raw("CASE
                            WHEN STATUS_ID = 1 THEN 'text-primary'
                            WHEN STATUS_ID = 2 THEN 'text-success'
                            ELSE 'text-danger'
                        END AS status_text")
            )
            ->get();

        return $data;
    }

    public function downloadFile($fileName)
    {
        if (Storage::disk('public')->exists("/documents/$fileName")) { // Check file existence
            return Storage::disk('public')->download("/documents/$fileName");
        } else {
            abort(404, 'File not found'); // Handle non-existent file
        }
    }
}
