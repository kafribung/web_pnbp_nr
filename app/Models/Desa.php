<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kua_id',
    ];

    public function kua()
    {
        $this->belongsTo(Kua::class);
    }

    public function pernikahans()
    {
        return $this->hasMany(Pernikahan::class);
    }
}
