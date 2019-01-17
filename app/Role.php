<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
        //table name
        protected $table = 'roles';
        //primary key
        public $primaryKey = 'id';
        //timestamps
        public $timestamps = true;

        public function users(){
            return $this->hasMany('App\User');
        }

        public function rights(){

            return $this->belongsToMany('App\Right', 'right_role', 'role_id', 'right_id');
        }
}
