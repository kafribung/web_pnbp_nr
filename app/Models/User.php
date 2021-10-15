<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kua_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pernikahans()
    {
        return $this->hasMany(Pernikahan::class, 'created_by');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function kua()
    {
        return $this->belongsTo(Kua::class);
    }

    /**
    * Role
    */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->count() == 1) return true;
        else return false;
    }
}
