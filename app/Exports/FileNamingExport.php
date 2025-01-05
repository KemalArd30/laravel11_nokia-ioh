<?php

namespace App\Exports;

use App\Models\FileNaming;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FileNamingExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FileNaming::withSitelist()
            ->leftJoin('regional_list', 'site_list.coa', '=', 'regional_list.coa')
            ->select(
                'file_naming.*', 
                'site_list.system_key', 
                'site_list.site_id', 
                'site_list.site_name', 
                'site_list.phase_name', 
                'regional_list.regional'
            )
            ->get()
            ->map(function ($fileNaming) {
                return [
                    $fileNaming->site_id,
                    $fileNaming->site_name,
                    $fileNaming->regional,
                    $fileNaming->system_key,
                    $fileNaming->phase_name,
                    $fileNaming->tssr_file_naming,
                    $fileNaming->sid_file_naming,
                    $fileNaming->netgear_mos_file_naming,
                    $fileNaming->lld_file_naming,
                    $fileNaming->abdw_file_naming,
                    $fileNaming->abdn_file_naming,
                    $fileNaming->boq_file_naming,
                    $fileNaming->atf_file_naming,
                    $fileNaming->atp_file_naming,
                    $fileNaming->created_at,
                    $fileNaming->last_update,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Site ID',
            'Site Name',
            'Regional',
            'System Key',
            'Phase Name',
            'TSSR File Naming',
            'SID File Naming',
            'NETGear MOS File Naming',
            'LLD File Naming',
            'ABDW File Naming',
            'ABDN File Naming',
            'BOQ File Naming',
            'ATF File Naming',
            'ATP File Naming',
            'Created At',
            'Last Update',
        ];
    }
}
