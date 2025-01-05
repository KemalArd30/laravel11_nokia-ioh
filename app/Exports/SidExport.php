<?php

namespace App\Exports;

use App\Models\Tss;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SidExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tss::joinWithPbiTss()
            ->get()
            ->map(function ($tss) {
                return [
                    $tss->site_id,
                    $tss->site_name,
                    $tss->project_year,
                    $tss->regional,
                    $tss->smp_id,
                    $tss->status_site,
                    $tss->phase_name,
                    $tss->fill_tss_checklist_complete,
                    $tss->review_by_scm,
                    $tss->review_by_pe,
                    $tss->tssr_done,
                    $tss->aging_survey_to_tss_submit,
                    $tss->total_aging_tss,
                    $tss->upload_date_sid_ppm,
                    $tss->url_sid_ppm,
                    $tss->remark,
                    $tss->last_update,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Site ID',
            'Site Name',
            'Project Year',
            'Regional',
            'SMP-ID',
            'Status Site',
            'Phase Name',
            'Fill TSS Checklist Complete',
            'Review by SCM',
            'Review by PE',
            'TSS Approved Date',
            'Aging Survey - TSS Submit',
            'Total Aging TSS',
            'Upload Date SID PPM',
            'Url SID PPM',
            'Remark',
            'Last Update',
        ];
    }
}
