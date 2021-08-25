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
}
