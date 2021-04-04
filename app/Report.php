<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function casher(){
        return $this->belongsTo(Casher::class);
    }
}
