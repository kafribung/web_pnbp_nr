<?php

namespace App\Models;

use App\Http\Livewire\Penghulu\Penghulu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function penghulus()
    {
        return $this->hasMany(Penghulu::class);
    }
}
