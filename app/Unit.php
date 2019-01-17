<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //table name
    protected $table = 'units';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = false;

    public function forms(){
        return $this->hasMany('App\Form');
    }
}
