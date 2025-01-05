<?php

namespace App\Imports;

use App\Models\FileNaming;
use App\Models\Sitelist;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileNamingImport implements ToModel, WithHeadingRow
{
    private $errors = [];
    private $unfoundRecords = [];

    public function model(array $row)
    {
        // Validasi jika `system_key` tidak ada di tabel Sitelist
        $sitelist = Sitelist::where('system_key', $row['system_key'])->first();

        if (!$sitelist) {
            // Data tidak ditemukan di tabel Sitelist
            $this->unfoundRecords[] = [
                'system_key' => $row['system_key'],
                'site_id' => $row['site_id'],
                'site_name' => $row['site_name'],
            ];
            return null;
        }

        // Validasi jika `system_key` sudah ada di FileNaming
        $fileNaming = FileNaming::where('system_key', $row['system_key'])->first();

        if ($fileNaming) {
            // Data sudah ada di FileNaming
            if ($fileNaming->tssr_file_naming || $fileNaming->sid_file_naming || 
                $fileNaming->netgear_mos_file_naming || $fileNaming->lld_file_naming || 
                $fileNaming->abdw_file_naming || $fileNaming->abdn_file_naming || 
                $fileNaming->boq_file_naming || $fileNaming->atf_file_naming || 
                $fileNaming->atp_file_naming) {
                
                // File naming sudah terisi
                $this->errors[] = $row['system_key'] . ' ' . $row['site_id'] . ' ' . $row['site_name'];
                return null;
            }
        }

        // Jika `system_key` ada dan file naming belum terisi, update atau insert data
        FileNaming::updateOrCreate(
            ['system_key' => $row['system_key']],
            [
                'tssr_file_naming' => $row['tssr_file_naming'],
                'sid_file_naming' => $row['sid_file_naming'],
                'netgear_mos_file_naming' => $row['netgear_mos_file_naming'],
                'lld_file_naming' => $row['lld_file_naming'],
                'abdw_file_naming' => $row['abdw_file_naming'],
                'abdn_file_naming' => $row['abdn_file_naming'],
                'boq_file_naming' => $row['boq_file_naming'],
                'atf_file_naming' => $row['atf_file_naming'],
                'atp_file_naming' => $row['atp_file_naming'],
            ]
        );
    }

    // Fungsi untuk mendapatkan data yang tidak ditemukan
    public function getUnfoundRecords()
    {
        return $this->unfoundRecords;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}