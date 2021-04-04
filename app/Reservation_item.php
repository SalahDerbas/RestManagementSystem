<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation_item extends Model
{
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
    public function meal(){
        return $this->belongsTo(Meal::class);
    }
    public function casher(){
        return $this->belongsTo(Casher::class);
    }
}
