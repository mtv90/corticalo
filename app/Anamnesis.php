<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    //table name
    protected $table = 'anamneses';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function forms(){
        return $this->belongsToMany('App\Form' , 'anamnesis_form', 'anamnesis_id', 'form_id'); 
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
