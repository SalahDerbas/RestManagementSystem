<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Casher extends Authenticatable
{
    use Notifiable;
// The authentication guard for admin
    protected $guard = 'casher';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password','salary'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reserveItems(){
        return $this->hasMany(Reservation_item::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
}
