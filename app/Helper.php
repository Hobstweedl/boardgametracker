<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper {

    public function start(){
        return 'echo404';
    }

    public function prettyDate($date){
        return date('M j, Y', strtotime($date) );
    }


    
}