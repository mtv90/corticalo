<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
     //table name
    protected $table = 'rights';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = false;


    public function roles(){

        return $this->belongsToMany('App\Role', 'right_role', 'right_id', 'role_id');
    }
}
