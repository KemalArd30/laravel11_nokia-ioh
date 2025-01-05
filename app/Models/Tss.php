<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tss extends Model
{
    protected $table = 'tss';
    public $timestamps = false;
    protected $primaryKey = 'id_tss';
    protected $casts = ['id_tss' => 'string'];
    protected $fillable = [
        'id_sitelist', 'id_tss', 'status_site', 'upload_date_tssr_ppm', 'url_tssr_ppm', 
        'upload_date_sid_ppm', 'url_sid_ppm', 'remark', 'remark_sid', 'last_update', 'last_update_sid'
    ];

    public function scopeJoinWithPbiTss($query)
    {
        return $query->join('site_list', 'tss.id_sitelist', '=', 'site_list.id_sitelist')
                     ->leftJoin('pbi_tss', 'site_list.smp_id', '=', 'pbi_tss.smp_id')
                     ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                     ->join('file_naming', 'tss.id_sitelist', '=', 'file_naming.id_sitelist')
                     ->select('pbi_tss.scm_assigned_to_fst', 
                              'pbi_tss.fill_tss_checklist_1_done',
                              'pbi_tss.fill_tss_checklist_2_done',
                              'pbi_tss.fill_tss_checklist_complete',
                              'pbi_tss.review_by_scm',
                              'pbi_tss.review_by_pe',
                              'pbi_tss.tssr_done',
                              'pbi_tss.aging_survey_to_tss_submit',
                              'pbi_tss.total_aging_tss',
                              'site_list.smp_id',
                              'site_list.site_id', 
                              'site_list.site_name', 
                              'site_list.project_year',
                              'site_list.phase_name', 
                              'site_list.system_key', 
                              'site_list.coa', 
                              'site_list.area', 
                              'site_list.zone', 
                              'site_list.phase_group', 
                              'site_list.sow',
                              'regional_list.regional',
                              'file_naming.tssr_file_naming',
                              'file_naming.sid_file_naming',
                              'tss.id_sitelist', 'tss.id_tss', 'tss.status_site', 'tss.upload_date_tssr_ppm', 'tss.url_tssr_ppm', 
                            'tss.upload_date_sid_ppm', 'tss.url_sid_ppm', 'tss.remark', 'tss.remark_sid', 'tss.last_update', 'tss.last_update_sid'); // Ambil semua kolom dari tabel tss
    }


    public function scopeforDashboardTssAgingLimit($query)
    {
        return $query->join('site_list', 'tss.id_sitelist', '=', 'site_list.id_sitelist')
                    ->leftJoin('pbi_tss', 'site_list.smp_id', '=', 'pbi_tss.smp_id')
                    ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                    ->select('regional_list.regional');
    }

    
    public static function countTssSubmitByRegionalAndAging($agingLimit)
    {
        $query = self::forDashboardTssAgingLimit()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->whereNotNull('pbi_tss.review_by_scm');

        $exceededCount = clone $query;
        $notExceededCount = clone $query;

        $exceededCount = $exceededCount
            ->selectRaw('
                regional_list.regional, 
                COUNT(*) as count
            ')
            ->whereRaw('DATEDIFF(pbi_tss.review_by_scm, pbi_tss.scm_assigned_to_fst) > ?', [$agingLimit])
            ->groupBy('regional_list.regional')
            ->get();

        $notExceededCount = $notExceededCount
            ->selectRaw('
                regional_list.regional, 
                COUNT(*) as count
            ')
            ->whereRaw('DATEDIFF(pbi_tss.review_by_scm, pbi_tss.scm_assigned_to_fst) <= ?', [$agingLimit])
            ->groupBy('regional_list.regional')
            ->get();

        return [
            'exceeded' => $exceededCount,
            'notExceeded' => $notExceededCount,
        ];
    }
}