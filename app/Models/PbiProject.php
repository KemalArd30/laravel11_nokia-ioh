<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PbiProject extends Model
{
    protected $table = 'pbi_project';
    public $timestamps = false;
    protected $fillable = [
        'region',
        'country',
        'project_name',
        'project_phase',
        'phase_group',
        'project_year',
        'system_key',
        'boq_no',
        'site_id',
        'site_name',
        'site_category',
        'smp_id',
        'smp_name',
        'smp_status',
        'wbs_code',
        'smp_site_type',
        'scope',
        'technology',
        'product_configuration',
        'module_id',
        'module_name',
        'module_status',
        'implementation_vendor_name',
        'milestone_and_inchstone',
        'task_id',
        'task_name',
        'task_status',
        'baseline_end_date',
        'forecast_end_date',
        'actual_end_date',
        'market_unit',
        'cpo_number',
        'ne_type'
    ];
}
