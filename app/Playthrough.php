<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Playthrough extends Model{

    public $timestamps = false;

    public function participants(){
    	return $this->hasMany('App\Participant');
    }

    public function players(){
        return $this->belongsToMany('App\Player', 'participants')->select();
    }

    public function game(){
    	return $this->hasOne('App\Game', 'id', 'game_id')->select(['id', 'name']);
    }

    public function winner(){
        return $this->hasOne('App\Player', 'id', 'player_id');
    }
}