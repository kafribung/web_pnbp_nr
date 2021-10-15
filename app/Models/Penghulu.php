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

    public function pernikahans()
    {
        return $this->hasMany(Pernikahan::class);
    }

    // Mutator
    public function getTakeImgAttribute()
    {
        return url('storage', $this->ttd_digital);
    }

    public function pph($jasaProfesi)
    {
        if ($this->golongan->name == 'Penghulu Pertama -  III/a' || $this->golongan->name == 'Penghulu Pertama - III/b' || $this->golongan->name == 'Penghulu Muda - III/c'  || $this->golongan->name == 'Penghulu Muda - III/d')
            return ($jasaProfesi * (5/100));
        else return ($jasaProfesi * (15/100));
    }

}
