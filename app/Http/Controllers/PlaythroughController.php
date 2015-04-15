<?php namespace App\Http\Controllers;

use Request;
use App\Game;

class PlaythroughController extends Controller {

   
    public function __construct()
    {
        
    }

    public function getIndex()
    {
        return view('welcome');
    }

    public function getList(){
        return view('playthrough.list');
    }

    public function getShow($id){
        return view('game.detail')->with(['game' => Game::find($id) ]);
    }

    public function getAdd(){
        return 'nothing here';
    }

}
