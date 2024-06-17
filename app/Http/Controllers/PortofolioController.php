<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\User;
use App\Helpers\MonthToRomanNumerals;
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
        $username = User::authUser()->USERNAME;
        $kategoriPortoID = $request->kategoriPorto;
        $namaPorto = $request->namaPorto;
        $kesesuaianPorto = $request->kesesuaianPorto;
        $tglPorto = $request->tglPorto;
        $noDokumenPorto = $request->noDokumenPorto;
        $file = $request->file('fileDokumen');
        $fileName = $file ? $username . '_' . $kategoriPortoID . '_' . str_replace(' ', '', $file->getClientOriginalName()) : null;

        $this->insertValidation($request);

        try {
            if (!$file) {
                throw new Exception('Silahkan upload dokumen terlebih dahulu!');
            }

            $userID = DB::table('mahasiswa')->where('NIM', $username)->value('ID');

            DB::table('portofolio')->insert([
                'ID_MAHASISWA' => $userID,
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
            // ->join('user', 'portofolio.USER_ID', 'user.ID')
            ->join('mahasiswa AS mhs', 'portofolio.ID_MAHASISWA', 'mhs.ID')
            ->select(
                'portofolio.ID AS ID_PORTOFOLIO',
                'portofolio.ID_MAHASISWA',
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
        $username = User::authUser()->USERNAME;

        $data = DB::table('portofolio')
            ->join('kategori_portofolio AS kp', 'portofolio.KATEGORI_PORTOFOLIO_ID', 'kp.ID')
            ->join('status_portofolio AS ss', 'portofolio.STATUS_ID', 'ss.ID')
            ->join('mahasiswa', 'portofolio.ID_MAHASISWA', 'mahasiswa.ID')
            ->where('mahasiswa.NIM', $username)
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
        DB::transaction(function () use ($request) {
            $portofolioID = $request->portofolioID;
            $userID = $request->userID;
            $status = $request->status;
            $notes = $request->notes;

            $mhs = DB::table('mahasiswa')->where('ID', $userID)->first();

            if ($status == 2) {
                $month = MonthToRomanNumerals::generate(date('n'));

                $latestNoSKPI = DB::table('skpi')->max('NO_SKPI');
                $counter = explode('/', $latestNoSKPI)[0];

                if ($latestNoSKPI) {
                    $counter++;
                    $noSKPINew = str_pad($counter, 7, 0, STR_PAD_LEFT);
                } else {
                    $noSKPINew = str_pad(1, 7, 0, STR_PAD_LEFT);
                }

                $formatNoSKPI = $noSKPINew . '/SKPI/UNWAHA/' . $month . '/' . date('Y');

                DB::table('skpi')->insert([
                    'NO_SKPI' => $formatNoSKPI,
                    'NIM_MAHASISWA' => $mhs->NIM,
                    'TANGGAL_SKPI' => date('Y-m-d'),
                    'STATUS' => 0
                ]);
            }

            DB::table('portofolio')
                ->where('ID', $portofolioID)
                ->where('ID_MAHASISWA', $mhs->ID)
                ->update(['STATUS_ID' => $status, 'NOTES' => $notes]);
        });

        return response()->json(['status' => 'ok', 'message' => 'Berhasil update status portofolio!']);
    }

    public function getAllSKPI()
    {
        $data = DB::table('skpi')
            ->join('mahasiswa', 'skpi.NIM_MAHASISWA', 'mahasiswa.NIM')
            ->select('skpi.NO_SKPI', 'mahasiswa.NAMA AS NAMA_MAHASISWA', 'skpi.TANGGAL_SKPI', 
                DB::raw("CASE
                    WHEN skpi.STATUS = 0 THEN 'Belum Disetujui'
                    WHEN skpi.STATUS = 1 THEN 'Disetujui'
                END AS STATUS"))
            ->get();

        return $data;
    }
}
