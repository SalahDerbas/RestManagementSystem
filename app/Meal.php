<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function reservations(){
        return $this->hasMany(Reservation_item::class);
    }
}
