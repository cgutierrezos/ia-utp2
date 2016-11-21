<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class edge extends Model
{
    protected $table = 'edges';

    protected $fillable = ['grafo_id','nodei_id','nodef_id','value'];

    
    public function grafo(){
    	return $this->belongsTo('App\grafo');
    }

    public function node(){
    	return $this->belongsTo('App\node');
    }


}
