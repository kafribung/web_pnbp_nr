<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pernikahan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function penghulu()
    {
        return $this->belongsTo(Penghulu::class);
    }

    public function peristiwa_nikah()
    {
        return $this->belongsTo(PeristiwaNikah::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function kua()
    {
        return $this->belongsTo(Kua::class);
    }
}
