<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Implementasi extends Model
{
    protected $table = 'implementasi';
    public $timestamps = false;
    protected $primaryKey = 'id_implementasi';
    protected $casts = ['id_implementasi' => 'string'];
    protected $fillable = [
        'id_sitelist', 'id_implementasi', 'status_site', 'ms13_ready_for_implementation',
        'is13_1_main_equipment_is_onsite', 'ms15_implementation_starts', 'is15_1_installation_complete', 'is15_4_integration_complete',
        'ms16_implementation_ends', 'ms17_site_acceptance', 'oa_date', 'status_oa', 'remark', 'last_update'
    ];

    public function scopeJoinWithPbiProject($query)
    {
    return $query->join('site_list', 'implementasi.id_sitelist', '=', 'site_list.id_sitelist')
                ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                ->select(
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
                    'implementasi.*',
                );
    }
}
