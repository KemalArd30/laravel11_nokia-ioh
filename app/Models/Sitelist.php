<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sitelist extends Model
{
    use HasFactory;

    protected $table = 'site_list';
    public $timestamps = false;
    protected $primaryKey = 'id_sitelist';
    
    protected $casts = [
        'coa' => 'string',
        'id_sitelist' => 'string',
        'project_year' => 'string',
    ];
    protected $fillable = [
        'id_sitelist', 'coa', 'area', 'zone', 'project_year',
        'main_project', 'system_key', 'smp_id', 'site_id', 'site_name',
        'status_site', 'phase_name', 'phase_group', 'sow', 'sow_detail',
        'category_scope', 'remark', 'last_update'
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

    public static function generateSitelistId($dateCreated)
    {
        $lastId = self::whereDate('created_at', Carbon::createFromFormat('dmY', $dateCreated))
            ->max(DB::raw("CAST(SUBSTRING(id_sitelist, -3) AS UNSIGNED)"));

        $maxId = $lastId ? $lastId + 1 : 1;

        return sprintf("%s_NSN_IOH_%03d", $dateCreated, $maxId);
    }


    public function scopeWithRegion($query)
    {
        return $query->leftJoin('regional_list', 'site_list.coa', '=', 'regional_list.coa')
                    ->select('site_list.*', 'regional_list.regional');
    }
}