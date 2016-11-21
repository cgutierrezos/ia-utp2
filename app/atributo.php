<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atributo extends Model
{
    protected $table = 'atributos';

    protected $fillable = ['name'];


    public function objetos(){
    	return $this->hasMany('App\objeto_atributo');
    }


}
