<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formtype extends Model
{
        //table name
        protected $table = 'formtypes';
        //primary key
        public $primaryKey = 'id';
        //timestamps
        public $timestamps = true;


        public function forms()
        {
            return $this->hasMany('App\Form');
        }
}
