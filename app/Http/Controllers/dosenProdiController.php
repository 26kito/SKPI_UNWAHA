<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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

    public function listPortofolio()
    {
        return view('list-portofolio');
    }

    public function listSkpi()
    {
        return view('list-skpi');
    }

    public function validateSkpi()
    {

        return view('form-validate-skpi');
    }

    public function actionValidateSkpi(Request $request)
    {
        $code = $request->encryptionCode;

        try {
            if (!$code || $code == null) {
                throw new DecryptException('Isi encrpytion code terlebih dahulu');
            }

            $decryptedCode = Crypt::decryptString($code);
            $data = DB::table('skpi')->join('mahasiswa', 'skpi.ID_MAHASISWA', 'mahasiswa.ID')->where('NO_SKPI', $decryptedCode)->first();

            $tglMasuk = new DateTime($data->TANGGAL_MASUK);
            $tglLulus = new DateTime($data->TANGGAL_LULUS);
            $interval = $tglMasuk->diff($tglLulus);

            $data->LAMA_STUDI = "$interval->y tahun $interval->m bulan";

            if (!$data) {
                throw new DecryptException('Data tidak ditemukan!');
            }

            return view('validate-skpi')->with('data', $data);
        } catch (DecryptException $e) {
            $message = $e->getMessage();

            return redirect()->back()->with(['status' => 'not ok', 'message' => $message]);
        }
    }
}
