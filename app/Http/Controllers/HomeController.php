<?php

namespace App\Http\Controllers;

use App\Helpers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $data = null;

        if (User::authUser()->ROLE == 'ADMIN') {
            $data = DB::table('portofolio')
                ->selectRaw("
                COUNT(*) AS total_mengajukan,
                COUNT(DISTINCT ID_MAHASISWA) AS total_mhs,  
                (SELECT COUNT(*) FROM portofolio WHERE STATUS_ID = 1) AS total_menunggu,
                (SELECT COUNT(DISTINCT ID_MAHASISWA) FROM portofolio WHERE STATUS_ID = 1) AS total_mhs_menunggu,
                (SELECT COUNT(*) FROM portofolio WHERE STATUS_ID = 2) AS total_disetujui,
                (SELECT COUNT(DISTINCT ID_MAHASISWA) FROM portofolio WHERE STATUS_ID = 2) AS total_mhs_disetujui,
                (SELECT COUNT(*) FROM portofolio WHERE STATUS_ID = 3) AS total_ditolak,
                (SELECT COUNT(DISTINCT ID_MAHASISWA) FROM portofolio WHERE STATUS_ID = 3) AS total_mhs_ditolak")
                ->first();
        }

        return view('index')->with('data', $data);
    }

    public function downloadFile()
    {
        $fileName = 'format_tambah_mahasiswa.xlsx';
        $filePath = public_path($fileName);

        // Validate filename and ensure it exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found'); // Handle non-existent file
        }

        return response()->download($filePath, $fileName);
    }
}
