<?php

namespace App\Exports;

use App\Models\Tss;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TssExport implements FromCollection, WithHeadings
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
                    $tss->scm_assigned_to_fst,
                    $tss->fill_tss_checklist_complete,
                    $tss->review_by_scm,
                    $tss->review_by_pe,
                    $tss->tssr_done,
                    $tss->aging_survey_to_tss_submit,
                    $tss->total_aging_tss,
                    $tss->upload_date_tssr_ppm,
                    $tss->url_tssr_ppm,
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
            'SCM Assigned to FST',
            'Fill TSS Checklist Complete',
            'Review by SCM',
            'Review by PE',
            'TSS Approved Date',
            'Aging Survey - TSS Submit',
            'Total Aging TSS',
            'Upload Date TSSR PPM',
            'Url TSSR PPM',
            'Remark',
            'Last Update',
        ];
    }
}
