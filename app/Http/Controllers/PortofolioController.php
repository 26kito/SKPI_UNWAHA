<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function view()
    {
        $data = DB::table('kategori_portofolio')->get();

        return view('input-porto')->with('data', $data);
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

            DB::table('portofolio')->insert([
                'USER_ID' => $userID,
                'KATEGORI_PORTOFOLIO_ID' => $kategoriPortoID,
                'NAMA' => $namaPorto,
                'IS_SESUAI' => $kesesuaianPorto,
                'TANGGAL_PORTOFOLIO' => $tglPorto,
                'NO_DOKUMEN' => $noDokumenPorto,
                'NAMA_FILE' => $fileName,
                'STATUS_ID' => 1 // Menunggu Persetujuan
            ]);

            Storage::disk('public')->putFileAs('documents', $file, $fileName);

            return redirect()->back()->with(['status' => 'ok', 'message' => 'Berhasil input portofolio!']);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();

            if (strpos($errorMessage, 'SQL') !== false) {
                $errorMessage = "Data gagal disimpan!";
            }

            return redirect()->back()->with(['status' => 'not ok', 'message' => $errorMessage]);
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

    public function getAllPortofolio()
    {
        $data = DB::table('portofolio')
            ->join('kategori_portofolio AS kp', 'portofolio.KATEGORI_PORTOFOLIO_ID', 'kp.ID')
            ->join('status_portofolio AS ss', 'portofolio.STATUS_ID', 'ss.ID')
            ->join('user', 'portofolio.USER_ID', 'user.ID')
            ->join('mahasiswa AS mhs', 'user.USERNAME', 'mhs.NIM')
            ->select(
                'portofolio.ID AS ID_PORTOFOLIO',
                'mhs.NAMA AS NAMA_MAHASISWA',
                'kp.KATEGORI AS KATEGORI_PORTOFOLIO',
                'portofolio.NAMA AS NAMA_PORTOFOLIO',
                'portofolio.IS_SESUAI',
                'portofolio.TANGGAL_PORTOFOLIO',
                'portofolio.NO_DOKUMEN',
                'portofolio.STATUS_ID',
                'ss.STATUS',
                'portofolio.NAMA_FILE',
                DB::raw("CASE
                            WHEN STATUS_ID = 1 THEN 'text-primary'
                            WHEN STATUS_ID = 2 THEN 'text-success'
                            ELSE 'text-danger'
                        END AS status_text")
            )
            ->get();

        return $data;
    }

    public function getPortofolio()
    {
        $userID = User::authUser()->ID;

        $data = DB::table('portofolio')
            ->join('kategori_portofolio AS kp', 'portofolio.KATEGORI_PORTOFOLIO_ID', 'kp.ID')
            ->join('status_portofolio AS ss', 'portofolio.STATUS_ID', 'ss.ID')
            ->where('portofolio.USER_ID', $userID)
            ->select(
                'kp.KATEGORI AS KATEGORI_PORTOFOLIO',
                'portofolio.NAMA AS NAMA_PORTOFOLIO',
                'portofolio.IS_SESUAI',
                'portofolio.TANGGAL_PORTOFOLIO',
                'portofolio.NO_DOKUMEN',
                'portofolio.STATUS_ID',
                'ss.STATUS',
                'portofolio.NAMA_FILE',
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

    public function updateStatusPortofolio(Request $request)
    {
        $portofolioID = $request->portofolioID;
        $status = $request->status;

        DB::table('portofolio')->where('ID', $portofolioID)->update(['STATUS_ID' => $status]);

        return response()->json(['status' => 'ok', 'message' => 'Berhasil update status portofolio!']);
    }
}
