<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //table name
    protected $table = 'groups';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function users(){
        return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id');
    }

    public function studies(){
        return $this->belongsToMany('App\Study', 'group_study', 'group_id', 'study_id');
    }

    public function crfs(){
        return $this->belongsToMany('App\CRF', 'crf_group', 'group_id', 'crf_id');
    }
}
