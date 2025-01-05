<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atp extends Model
{
    protected $table = 'doc_acceptance';
    public $timestamps = false;
    protected $primaryKey = 'id_implementasi';
    protected $casts = ['id_implementasi' => 'string'];
    protected $fillable = [
        'id_sitelist', 'id_implementasi', 'status_task_atp_born', 'status_take_data_atp_born', 'atp_internal_review_date', 
        'pic_atp_internal_review', 'atp_submit_date', 'atp_reject_date', 'atp_rectification_date', 'atp_approved_date', 'atp_status', 
        'url_atp_ppm', 'aging_oa_to_atp_submit', 'total_aging_atp', 'remark', 'last_update'
    ];

    public function scopeJoinWithSitelistAndImplementasi($query)
    {
        return $query->join('site_list', 'doc_acceptance.id_sitelist', '=', 'site_list.id_sitelist')
                 ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                 ->join('file_naming', 'doc_acceptance.id_sitelist', '=', 'file_naming.id_sitelist')
                 ->leftJoin('pbi_tss', 'site_list.smp_id', '=', 'pbi_tss.smp_id')
                 ->join('tss', 'doc_acceptance.id_sitelist', '=', 'tss.id_sitelist')
                 ->join('netgear_mos', 'doc_acceptance.id_implementasi', '=', 'netgear_mos.id_implementasi')
                 ->join('doc_lld', 'doc_acceptance.id_implementasi', '=', 'doc_lld.id_implementasi')
                 ->join('doc_abd', 'doc_acceptance.id_implementasi', '=', 'doc_abd.id_implementasi')
                 ->join('doc_boq', 'doc_acceptance.id_implementasi', '=', 'doc_boq.id_implementasi')
                 ->join('netgear_atf', 'doc_acceptance.id_implementasi', '=', 'netgear_atf.id_implementasi')
                 ->join('implementasi', 'doc_acceptance.id_implementasi', '=', 'implementasi.id_implementasi')
                 ->select( 'site_list.site_id', 
                            'site_list.site_name', 
                            'site_list.project_year',
                            'site_list.phase_name', 
                            'site_list.system_key',
                            'site_list.smp_id', 
                            'site_list.coa', 
                            'site_list.area', 
                            'site_list.zone', 
                            'site_list.phase_group', 
                            'site_list.sow',
                            'regional_list.regional',
                            'file_naming.atp_file_naming',
                            'pbi_tss.tssr_done',
                            'tss.url_tssr_ppm',
                            'tss.upload_date_sid_ppm',
                            'tss.url_sid_ppm',
                            'netgear_mos.netgear_mos_status',
                            'netgear_mos.upload_date_netgear_mos_ppm',
                            'netgear_mos.url_netgear_mos_ppm',
                            'doc_lld.upload_date_lld_ppm',
                            'doc_lld.url_lld_ppm',
                            'doc_abd.upload_date_abdw_ppm',
                            'doc_abd.upload_date_abdn_ppm',
                            'doc_abd.url_abdn_ppm',
                            'doc_boq.upload_date_boq_ppm',
                            'doc_boq.url_boq_ppm',
                            'netgear_atf.upload_date_atf_ppm',
                            'netgear_atf.url_atf_ppm',
                            'implementasi.status_site',
                            'implementasi.oa_date',
                            'implementasi.status_oa',
                            'doc_acceptance.*'); // Ambil semua kolom dari tabel doc_acceptance
    }

    public function scopeforDashboardAtpAgingLimit($query)
    {
        return $query->join('site_list', 'doc_acceptance.id_sitelist', '=', 'site_list.id_sitelist')
                 ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                 ->join('implementasi', 'doc_acceptance.id_implementasi', '=', 'implementasi.id_implementasi')
                 ->select('regional_list.regional',);
    }

    public static function countAtpSubmitByRegionalAndAging($agingLimit)
    {
        $query = self::forDashboardAtpAgingLimit()
            ->whereNotNull('implementasi.oa_date')
            ->whereNotNull('doc_acceptance.atp_submit_date');

        $exceededCount = clone $query;
        $notExceededCount = clone $query;

        $exceededCount = $exceededCount
            ->selectRaw('
                regional_list.regional, 
                COUNT(*) as count
            ')
            ->whereRaw('DATEDIFF(doc_acceptance.atp_submit_date, implementasi.oa_date) > ?', [$agingLimit])
            ->groupBy('regional_list.regional')
            ->get();

        $notExceededCount = $notExceededCount
            ->selectRaw('
                regional_list.regional, 
                COUNT(*) as count
            ')
            ->whereRaw('DATEDIFF(doc_acceptance.atp_submit_date, implementasi.oa_date) <= ?', [$agingLimit])
            ->groupBy('regional_list.regional')
            ->get();

        return [
            'exceeded' => $exceededCount,
            'notExceeded' => $notExceededCount,
        ];
    }
}
