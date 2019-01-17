<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function forms(){
        return $this->belongsToMany('App\Form', 'form_result', 'result_id', 'form_id');
    }

    public function crfs(){
        return $this->belongsTo('App\CRF');
    }

    public function choices(){
        return $this->belongsToMany('App\Choice', 'choice_result', 'result_id', 'choice_id');
    }

    public function studies(){
        return $this->belongsTo('App\Study');
    }

    public function patients(){
        return $this->belongsTo('App\Patient');
    }
    public function textresults(){
        return $this->hasMany('App\Textresult');
    }
    public function textarearesults(){
        return $this->hasMany('App\Textarearesult');
    }
    public function dateresults(){
        return $this->hasMany('App\Dateresult');
    }
    public function doubleresults(){
        return $this->hasMany('App\Doubleresult');
    }
    public function integerresults(){
        return $this->hasMany('App\Integerresult');
    }
    public function timeresults(){
        return $this->hasMany('App\Timeresult');
    }
    public function yearresults(){
        return $this->hasMany('App\Yearresult');
    }
}
