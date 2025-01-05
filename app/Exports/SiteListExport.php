<?php

namespace App\Exports;

use App\Models\SiteList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiteListExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SiteList::withRegion()
            ->get()
            ->map(function ($siteList) {
                return [
                    $siteList->project_year,
                    $siteList->regional,
                    $siteList->site_id,
                    $siteList->site_name,
                    $siteList->system_key,
                    $siteList->smp_id,
                    $siteList->status_site,
                    $siteList->phase_name,
                    $siteList->sow_detail,
                    $siteList->remark,
                    $siteList->created_at,
                    $siteList->last_update,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Project Year',
            'Regional',
            'Site ID',
            'Site Name',
            'System Key',
            'SMP-ID',
            'Status Site',
            'Phase Name',
            'SOW Detail',
            'Remark',
            'Created At',
            'Last Update',
        ];
    }
}
