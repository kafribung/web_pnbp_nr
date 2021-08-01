<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghulu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function kua()
    {
        return $this->belongsTo(Kua::class);
    }

}
