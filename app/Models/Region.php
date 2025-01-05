<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regional_list'; // Pastikan nama tabel benar

    protected $primaryKey = 'coa'; // Ganti dengan kolom yang Anda gunakan sebagai primary key

    protected $casts = [
        'coa' => 'string',
    ];

    public $incrementing = false; // Karena `coa` bukan auto-increment

    protected $fillable = ['coa', 'project', 'regional', 'created_at', 'last_update'];

    // Jika Anda tidak menggunakan timestamps, tambahkan properti berikut
    public $timestamps = false; // Jika tabel Anda tidak memiliki kolom created_at dan updated_at



    public function toSitelist()
{
    return $this->hasMany(Sitelist::class, 'coa', 'coa');
}
}