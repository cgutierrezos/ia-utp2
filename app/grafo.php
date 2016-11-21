<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grafo extends Model
{
    //

    protected $table = 'grafos';

    protected $fillable = ['user_id','name','comments'];

    public function nodes(){
    	return $this->hasMany('App\node');
    }

    public function edges(){
    	return $this->hasMany('App\edge');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
