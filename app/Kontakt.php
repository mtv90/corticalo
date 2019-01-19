<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontakt extends Model
{
    
    protected $table = 'kontakts';
    
    public $primaryKey = 'id';
    
    public $timestamps = true;

    protected $fillable = [
        'vorname', 'nachname', 'telefon', 'email', 'betreff', 'message'
    ];
}
