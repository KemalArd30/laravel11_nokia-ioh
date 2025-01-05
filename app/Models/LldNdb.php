<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LldNdb extends Model
{
    protected $table = 'doc_lld';
    public $timestamps = false;
    protected $primaryKey = 'id_implementasi';
    protected $casts = ['id_implementasi' => 'string'];
    protected $fillable = [
        'id_sitelist', 'id_implementasi', 'upload_date_lld_ppm', 'url_lld_ppm', 
        'remark', 'last_update'
    ];

    public function scopeWithSitelistAndImplementasi($query)
    {
        return $query->join('site_list', 'doc_lld.id_sitelist', '=', 'site_list.id_sitelist')
                 ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                 ->join('file_naming', 'doc_lld.id_sitelist', '=', 'file_naming.id_sitelist')
                 ->join('implementasi', 'doc_lld.id_implementasi', '=', 'implementasi.id_implementasi')
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
                            'file_naming.lld_file_naming',
                            'implementasi.status_site',
                            'implementasi.oa_date',
                            'implementasi.status_oa',
                            'doc_lld.*'); // Ambil semua kolom dari tabel doc_lld
    }
}