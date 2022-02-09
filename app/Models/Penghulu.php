<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HisotryPermohonanPembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        if ($this->golongan->name == 'Penghulu Pertama - III/a' || $this->golongan->name == 'Penghulu Pertama - III/b' || $this->golongan->name == 'Penghulu Muda - III/c'  || $this->golongan->name == 'Penghulu Muda - III/d')
            return ($jasaProfesi * (5/100));
        else return ($jasaProfesi * (15/100));
    }

    public function historyPermohonanPembayaran(array $data)
    {
        if ($data['cost']) {
            if ($permohonanPembayaran =  HisotryPermohonanPembayaran::where('kua_id', $data['kua_id'])->where('month', $data['month'])->where('year', $data['year'])->first()) {
                $data['updated_by'] = auth()->id();
                $permohonanPembayaran->update($data);
            } else {
                $data['created_by'] = auth()->id();
                HisotryPermohonanPembayaran::create($data);
            }
        }

    }
}
