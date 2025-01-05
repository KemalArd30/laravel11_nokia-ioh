<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abd extends Model
{
    protected $table = 'doc_abd';
    public $timestamps = false;
    protected $primaryKey = 'id_implementasi';
    protected $casts = ['id_implementasi' => 'string'];
    protected $fillable = [
        'id_sitelist', 'id_implementasi', 'upload_date_abdw_ppm', 'url_abdw_ppm', 'upload_date_abdn_ppm', 'url_abdn_ppm',
        'remark', 'last_update'
    ];

    public function scopeWithSitelistAndImplementasi($query)
    {
        return $query->join('site_list', 'doc_abd.id_sitelist', '=', 'site_list.id_sitelist')
                 ->join('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                 ->join('implementasi', 'doc_abd.id_implementasi', '=', 'implementasi.id_implementasi')
                 ->join('file_naming', 'doc_abd.id_sitelist', '=', 'file_naming.id_sitelist')
                 ->leftJoin('doc_acceptance', 'doc_abd.id_implementasi', '=', 'doc_acceptance.id_implementasi')
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
                            'implementasi.status_site',
                            'implementasi.oa_date',
                            'implementasi.status_oa',
                            'file_naming.abdw_file_naming',
                            'file_naming.abdn_file_naming',
                            'doc_acceptance.status_take_data_atp_born',
                            'doc_acceptance.atp_internal_review_date',
                            'doc_abd.*'); // Ambil semua kolom dari tabel doc_abd
    }
}
