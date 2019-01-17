<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vorname', 'nachname', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function forms(){
        return $this->hasMany('App\Form');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function studies(){
        return $this->hasMany('App\Study');
    }

    public function anamneses(){
        return $this->hasMany('App\Anamnesis');
    }

    public function crfs(){
        return $this->hasMany('App\CRF');
    }

    public function choices(){
        return $this->hasMany('App\Choice');
    }
    public function results(){
        return $this->hasMany('App\Result');
    }
    public function patients(){
        return $this->hasMany('App\Patient');
    }

    public function groups(){
        return $this->belongsToMany('App\Group', 'group_user', 'user_id', 'group_id');
    }
}
