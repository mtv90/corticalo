<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //table name
    protected $table = 'choices';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function forms(){
        return $this->belongsTo('App\Form');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function results(){
        return $this->belongsToMany('App\Result', 'choice_result', 'form_id', 'choice_id');
    }
}
