<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    //table name
    protected $table = 'ranges';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = false;

    public function forms()
    {
        return $this->hasMany('App\Form');
    }
}
