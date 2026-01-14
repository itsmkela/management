<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; 

    protected $fillable = [
    'name', // or 'username' if your table uses that
    'email',
    'password',
];


    protected $hidden = [
        'password',
    ];
    
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}