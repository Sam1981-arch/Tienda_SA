<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\GarmentHasUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    protected $fillable = [
        'name',
        'email',
        'password',
		'number_id',
		'avatar'
    ];


    protected $hidden = [
        'password',

    ];

   public function BookHaUsers()
   {
     return $this->hasMany(BookHasUsers::class, 'users', 'id');
   }

}
