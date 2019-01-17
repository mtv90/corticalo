<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    //table name
    protected $table = 'forms';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    protected $fillable = [
        'frtext', 'formtype_id', 'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function crfs(){
        return $this->belongsToMany('App\CRF', 'crf_form', 'form_id', 'crf_id');
    }

    public function anamnesis(){
        return $this->belongsToMany('App\Anamnesis', 'anamnesis_form', 'form_id', 'anamnesis_id');
    }

    public function unit(){
        return $this->belongsTo('App\Unit');
    }
    
    public function textresults(){
        return $this->hasMany('App\Textresult');
    }

    public function textarearesults(){
        return $this->hasMany('App\Textarearesult');
    }

    public function choices(){
        return $this->hasMany('App\Choice');
    }

    public function formtypes()
    {
        return $this->belongsTo('App\Formtype');
    }

    public function format()
    {
        return $this->belongsTo('App\Format');
    }

    public function range()
    {
        return $this->belongsTo('App\Range');
    }
    public function results(){
        return $this->belongsToMany('App\Result', 'form_result', 'form_id', 'result_id');
    }

    public function doubleresults(){
        return $this->hasMany('App\Doubleresult');
    }

    public function integerresults(){
        return $this->hasMany('App\Integerresult');
    }
}
