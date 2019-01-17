<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Textresult extends Model
{
    public function results(){
        return $this->belongsTo('App\Result');
    }

    public function form(){
        return $this->belongsTo('App\Form');
    }
}
