<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sistemaexperto extends Model
{
    protected $table = 'sistemasexpertos';

    protected $fillable = ['user_id', 'name', 'comments'];

    public function objetos_atributos(){
    	return $this->hasMany('App\objeto_atributo');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    
}
