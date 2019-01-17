<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //table name
    protected $table = 'patient';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function formDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function results(){
        return $this->hasMany('App\Result');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function studies(){
        return $this->belongsToMany('App\Study', 'patient_study', 'patient_id', 'study_id');
    }
}
