<?php

namespace App;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $dates = ['date'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function items(){
        return $this->hasMany(Reservation_item::class);
    }

    public function getTime(){
        $date1=$this->date;
        $format = 'd-m-Y H:i:s A';
        $date = DateTime::createFromFormat($format, $date1);
        return $date->format('H:i:s A');

    }
}
