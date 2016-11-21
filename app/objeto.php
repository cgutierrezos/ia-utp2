<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objeto extends Model
{
    protected $table = 'objetos';

    protected $fillable = ['name'];

    public function atributos(){
    	return $this->hasMany('App\objeto_atributo');
    }


}
