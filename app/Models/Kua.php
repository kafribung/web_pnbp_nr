<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kua extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function penghulus()
    {
        return $this->hasMany(Penghulu::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function typology()
    {
        return $this->belongsTo(Typology::class);
    }

    public function desas()
    {
        return $this->hasMany(Desa::class);
    }

    public function hisotryPermohonanPembayaran()
    {
        return $this->hasMany(HisotryPermohonanPembayaran::class);
    }

    public function pernikahans()
    {
        return $this->hasMany(Pernikahan::class);
    }
}
