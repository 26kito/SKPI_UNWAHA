<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MahasiswaImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            DB::table('mahasiswa')
                ->upsert([
                    'NAMA' => strtoupper($row['nama_mahasiswa']),
                    'NIM' => $row['nim'],
                    'GELAR' => strtoupper($row['gelar']),
                    'PRODI' => strtoupper($row['prodi']),
                    'NIK' => $row['nik'],
                    'NAMA_IBU_KANDUNG' => strtoupper($row['nama_ibu_kandung']),
                    'TEMPAT_LAHIR' => strtoupper($row['tempat_lahir']),
                    'TANGGAL_LAHIR' => date('Y-m-d', strtotime($row['tanggal_lahir'])),
                    'TANGGAL_MASUK' => date('Y-m-d', strtotime($row['tanggal_masuk'])),
                    'TANGGAL_LULUS' => date('Y-m-d', strtotime($row['tanggal_lulus'])),
                    'NO_IJAZAH' => $row['no_ijazah'],
                    'EMAIL' => $row['email'],
                ], [
                    'NIM' // unique
                ], [
                    'NO_IJAZAH', 'EMAIL' // update
                ]);

            DB::table('user')
                ->insertOrIgnore([
                    'USERNAME' => $row['nim'],
                    'NAME' => strtoupper($row['nama_mahasiswa']),
                    'PASSWORD' => Hash::make(12345678),
                    'ROLE' => 'MAHASISWA',
                ]);
        }
    }
}
