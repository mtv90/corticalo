<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
        //table name
        protected $table = 'studies';
        //primary key
        public $primaryKey = 'id';
        //timestamps
        public $timestamps = true;

        public function user(){
            return $this->belongsTo('App\User');
        }

        public function crfs(){
            return $this->belongsToMany('App\CRF', 'crf_study', 'study_id', 'crf_id');
        }

        public function results(){
            return $this->hasMany('App\Result');
        }

        public function patients(){
            return $this->belongsToMany('App\Patient', 'patient_study', 'study_id', 'patient_id');
        }

        public function groups(){
            return $this->belongsToMany('App\Group', 'group_study', 'study_id', 'group_id');
        }
}
