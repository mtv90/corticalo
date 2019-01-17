<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    //table name
    protected $table = 'formats';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = false;

    public function forms()
    {
        return $this->hasMany('App\Form');
    }
}
