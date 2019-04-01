<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "users";
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function typeuser(){
        return $this->belongsTo('App\Typeuser', 'idTypeUser', 'id');
    }

    public function order(){
        return $this->hasMany('App\Order', 'idUser', 'id');
    }

    /*public function listComment(){
        return $this->hasMany('App\ListComment', 'idUser', 'id');
    }*/
}
