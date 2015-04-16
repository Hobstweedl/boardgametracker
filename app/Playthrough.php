<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Playthrough extends Model{

    public $timestamps = false;

    public function participants(){
    	return $this->hasMany('App\Participant');
    }

    public function game(){
    	return $this->hasOne('App\Game', 'id', 'game_id')->select(['id', 'name']);
    }

    public function players(){
    	return $this->hasManyThrough('App\Player', 'App\Participant', 'player_id', 'player_id');
    }
    
}