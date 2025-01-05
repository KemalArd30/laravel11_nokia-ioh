<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WccFullPayment extends Model
{
    protected $table = 'wcc_full_pay';

    // Nonaktifkan fitur timestamps
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'id_sitelist', 
        'id_scope', 
        'wcc_submit_date', 
        'wcc_resubmit_date', 
        'wcc_status', 
        'remark',
        'last_update', 
        'updated_by'
    ];

    public function scopeJoinToWccFullPayment($query)
    {
        return $query->leftJoin('site_list', 'wcc_full_pay.id_sitelist', '=', 'site_list.id_sitelist')
                ->leftJoin('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                ->leftJoin('pbi_tss', 'site_list.smp_id', '=', 'pbi_tss.smp_id')
                ->leftJoin('pbi_wcc_full_payment_data', 'site_list.smp_id', '=', 'pbi_wcc_full_payment_data.smp_id')
                ->leftJoin('tss', 'wcc_full_pay.id_scope', '=', 'tss.id_tss')
                ->leftJoin('netgear_mos', 'wcc_full_pay.id_scope', '=', 'netgear_mos.id_implementasi')
                ->leftJoin('doc_lld', 'wcc_full_pay.id_scope', '=', 'doc_lld.id_implementasi')
                ->leftJoin('doc_abd', 'wcc_full_pay.id_scope', '=', 'doc_abd.id_implementasi')
                ->leftJoin('doc_boq', 'wcc_full_pay.id_scope', '=', 'doc_boq.id_implementasi')
                ->leftJoin('netgear_atf', 'wcc_full_pay.id_scope', '=', 'netgear_atf.id_implementasi')
                ->leftJoin('implementasi', 'wcc_full_pay.id_scope', '=', 'implementasi.id_implementasi')
                ->leftJoin('doc_acceptance', 'wcc_full_pay.id_scope', '=', 'doc_acceptance.id_implementasi')
                ->select(
                    'site_list.site_id', 
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
                    'pbi_tss.tssr_done as tss_approved_date',
                    'tss.status_site as tss_status_site',
                    'tss.url_tssr_ppm',
                    'tss.url_sid_ppm',
                    'netgear_mos.url_netgear_mos_ppm',
                    'doc_lld.url_lld_ppm',
                    'doc_abd.url_abdn_ppm',
                    'doc_boq.url_boq_ppm',
                    'netgear_atf.url_atf_ppm',
                    'implementasi.status_site as implementasi_status_site',
                    'implementasi.oa_date',
                    'implementasi.status_oa',
                    'doc_acceptance.atp_approved_date as doc_acceptance_approved_date',
                    'doc_acceptance.url_atp_ppm',
                    'pbi_wcc_full_payment_data.ewcc_module_id',
                    'pbi_wcc_full_payment_data.ewcc_module_percentage',
                    'pbi_wcc_full_payment_data.spo_number',
                    'pbi_wcc_full_payment_data.spo_date',
                    'pbi_wcc_full_payment_data.target_time_of_completion',
                    'pbi_wcc_full_payment_data.actual_time_of_completion',
                    'pbi_wcc_full_payment_data.delay_justification',
                    'pbi_wcc_full_payment_data.wcc_assign_by_nokia',
                    'pbi_wcc_full_payment_data.wcc_submit_date',
                    'pbi_wcc_full_payment_data.wcc_reject_date',
                    'pbi_wcc_full_payment_data.wcc_verification_date',
                    'pbi_wcc_full_payment_data.wcc_approve_date',
                    'pbi_wcc_full_payment_data.gr_status',
                    DB::raw('CASE
                        WHEN pbi_wcc_full_payment_data.smp_id IS NULL AND wcc_full_pay.id_scope LIKE "%NSN_IOH_TSS%" THEN "STL11 NI TSS"
                        WHEN pbi_wcc_full_payment_data.smp_id IS NULL AND wcc_full_pay.id_scope LIKE "%NSN_IOH_IMPL%" THEN "STL21 NI IMPL"
                        WHEN pbi_wcc_full_payment_data.smp_id IS NULL AND wcc_full_pay.id_scope LIKE "%NSN_IOH_OTHER%" THEN "STL24 NI OTHERS"
                        ELSE pbi_wcc_full_payment_data.service_task
                    END AS service_task'),
                    'wcc_full_pay.*'
                )
                ->where(function($query) {
                    $query->whereNull('pbi_wcc_full_payment_data.smp_id')
                        ->orWhere(function($q) {
                            $q->where(function($subq) {
                                $subq->where('pbi_wcc_full_payment_data.service_task', '=', 'STL11 NI TSS')
                                    ->whereRaw("wcc_full_pay.id_scope LIKE '%NSN_IOH_TSS%'");
                            })
                            ->orWhere(function($subq) {
                                $subq->where('pbi_wcc_full_payment_data.service_task', '=', 'STL21 NI IMPL')
                                    ->whereRaw("wcc_full_pay.id_scope LIKE '%NSN_IOH_IMPL%'");
                            })
                            ->orWhere(function($subq) {
                                $subq->where('pbi_wcc_full_payment_data.service_task', '=', 'STL24 NI OTHERS')
                                    ->whereRaw("wcc_full_pay.id_scope LIKE '%NSN_IOH_OTHER%'");
                            });
                        });
                });
    }


    public function getDisplayStatusSiteAttribute()
    {
        if ($this->service_task == 'STL11 NI TSS') {
            return $this->tss_status_site;
        } elseif ($this->service_task == 'STL21 NI IMPL') {
            return $this->implementasi_status_site;
        } else {
            return $this->status_site;
        }
    }


    public function getDisplayDocApprovedDateAttribute()
    {
        if ($this->service_task == 'STL11 NI TSS') {
            return $this->tss_approved_date;
        } elseif ($this->service_task == 'STL21 NI IMPL') {
            return $this->doc_acceptance_approved_date;
        } else {
            return $this->doc_approved_date;
        }
    }
}