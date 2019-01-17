<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CRF extends Model {
    //table name
    protected $table = 'crfs';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function studies(){
        return $this->belongsToMany('App\Study', 'crf_study', 'crf_id', 'study_id');
    }

    public function forms(){
        return $this->belongsToMany('App\Form' , 'crf_form', 'crf_id', 'form_id'); 
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function results(){
        return $this->hasMany('App\Result');
    }

    public function groups(){
        return $this->belongsToMany('App\Group', 'crf_group', 'crf_id', 'group_id');
    }
}
