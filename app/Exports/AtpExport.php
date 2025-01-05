<?php

namespace App\Exports;

use App\Models\Atp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AtpExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Atp::JoinWithSitelistAndImplementasi()
            ->get()
            ->map(function ($atp) {
                return [
                    $atp->system_key,
                    $atp->smp_id,
                    $atp->site_id,
                    $atp->site_name,
                    $atp->project_year,
                    $atp->regional,
                    $atp->area,
                    $atp->coa,
                    $atp->status_site,
                    $atp->phase_name,
                    $atp->sow,
                    $atp->tssr_done,
                    $atp->oa_date,
                    $atp->status_oa,
                    $atp->status_take_data_atp_born,
                    $atp->pic_atp_internal_review,
                    $atp->atp_submit_date,
                    $atp->atp_reject_date,
                    $atp->atp_rectification_date,
                    $atp->atp_approved_date,
                    $atp->atp_status,
                    $atp->aging_oa_to_atp_submit,
                    $atp->total_aging_atp,
                    $atp->upload_date_tssr_ppm,
                    $atp->url_tssr_ppm,
                    $atp->upload_date_sid_ppm,
                    $atp->url_sid_ppm,
                    $atp->netgear_mos_status,
                    $atp->upload_date_netgear_mos_ppm,
                    $atp->url_netgear_mos_ppm,
                    $atp->upload_date_lld_ppm,
                    $atp->url_lld_ppm,
                    $atp->upload_date_abdn_ppm,
                    $atp->url_abdn_ppm,
                    $atp->upload_date_boq_ppm,
                    $atp->url_boq_ppm,
                    $atp->upload_date_atf_ppm,
                    $atp->url_atf_ppm,
                    $atp->url_atp_ppm,
                    $atp->remark,
                    $atp->last_update,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'System Key',
            'SMP-ID',
            'Site ID',
            'Site Name',
            'Project Year',
            'Region',
            'Area',
            'COA',
            'Status Site',
            'Phase Name',
            'SOW',
            'TSS Approved Date',
            'OA Date',
            'Status OA',
            'Status Take Data ATP Born',
            'PIC ATP Internal Review',
            'ATP Submit Date',
            'ATP Reject Date',
            'ATP Rectification Date',
            'ATP Approved Date',
            'ATP Status',
            'Aging OA to ATP Submit',
            'Total Aging ATP',
            'Upload Date TSSR PPM',
            'Url TSSR PPM',
            'Upload Date SID PPM',
            'Url SID PPM',
            'NETGear MOS Status',
            'Upload Date NETGear MOS PPM',
            'Url NETGear MOS PPM',
            'Upload Date LLD PPM',
            'Url LLD PPM',
            'Upload Date ABDN PPM',
            'Url ABDN PPM',
            'Upload Date BOQ PPM',
            'Url BOQ PPM',
            'Upload Date ATF PPM',
            'Url ATF PPM',
            'Url ATP PPM',
            'Remark',
            'Last Update',
        ];
    }
}
