<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model{

    protected $guarded = ['id'];
    public $timestamps = false;

    public function players(){
    	return $this->hasOne('App\User');
    }


    
}