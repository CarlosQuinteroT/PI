<?php

namespace App;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserG extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['usuario', 'password', 'condicion', 'idrol'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*public function rol(){
        return $this->belongsTo('App\Rol');
    }

    public function persona(){
        return $this->belongsTo('App\Persona');
    }*/


}
