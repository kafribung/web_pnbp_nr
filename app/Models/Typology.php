<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    use HasFactory;

    public $timestamps  = false;

    protected $fillable = [
        'name',
    ];

    public function kuas()
    {
        return $this->hasMany(Kua::class);
    }
}
