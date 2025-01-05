<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PbiTss extends Model
{
    protected $table = 'pbi_tss';
    public $timestamps = false;
    protected $fillable = [
        'customer_name', 'project_name', 'po_number', 'scopes', 'cluster', 'region', 'implementation_vendor', 'site_id', 'site_name', 'module_id', 
        'module_name', 'smp_id', 'smp_name', 'nokia_assign_to_scm', 'scm_assign_to_hs_manager', 'scm_assigned_to_fst', 'fill_tss_checklist_1_done', 
        'fill_tss_checklist_2_done', 'fill_tss_checklist_complete', 'review_by_scm', 'review_by_pe', 'tssr_done', 'aging_survey_to_tss_submit', 'total_aging_tss'
    ];
}
