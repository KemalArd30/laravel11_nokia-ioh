<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileNaming extends Model
{
    use HasFactory;

    protected $table = 'file_naming';
    public $timestamps = false;
    protected $primaryKey = 'id_sitelist';
    protected $casts = [
        'id_sitelist' => 'string',
    ];

    protected $fillable = [
        'id_sitelist', 'system_key', 'tssr_file_naming', 'sid_file_naming', 'netgear_mos_file_naming',
        'lld_file_naming', 'abdw_file_naming', 'abdn_file_naming', 'boq_file_naming', 'atf_file_naming',
        'atp_file_naming', 'created_at', 'last_update'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
            // Tidak perlu menyetel last_update ke null, biarkan null secara default
        });

        static::updating(function ($model) {
            $model->last_update = now();
        });

        static::saving(function ($model) {
            if ($model->exists) {
                $model->created_at = $model->getOriginal('created_at');
            }
        });
    }

    public function scopeWithSitelist($query)
    {
        return $query->leftJoin('site_list', 'file_naming.id_sitelist', '=', 'site_list.id_sitelist')
                    ->leftJoin('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                    ->select('file_naming.*', 'site_list.system_key', 'site_list.site_id', 'site_list.site_name', 'site_list.phase_name', 'regional_list.regional');
    }
}