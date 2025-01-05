<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetgearMos extends Model
{
    protected $table = 'netgear_mos';
    public $timestamps = false;
    protected $primaryKey = 'id_implementasi';
    protected $casts = ['id_implementasi' => 'string'];
    protected $fillable = [
        'id_sitelist', 'id_implementasi', 'netgear_mos_status', 'upload_date_netgear_mos_ppm', 
        'url_netgear_mos_ppm', 'remark', 'last_update'
    ];

    public function scopeWithSitelistAndImplementasi($query)
    {
        return $query->join('site_list', 'netgear_mos.id_sitelist', '=', 'site_list.id_sitelist')
                 ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                 ->join('file_naming', 'netgear_mos.id_sitelist', '=', 'file_naming.id_sitelist')
                 ->join('implementasi', 'netgear_mos.id_implementasi', '=', 'implementasi.id_implementasi')
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
                            'file_naming.netgear_mos_file_naming',
                            'implementasi.status_site',
                            'implementasi.is13_1_main_equipment_is_onsite',
                            'implementasi.oa_date',
                            'implementasi.status_oa',
                            'netgear_mos.*'); // Ambil semua kolom dari tabel netgear_mos
    }
}
