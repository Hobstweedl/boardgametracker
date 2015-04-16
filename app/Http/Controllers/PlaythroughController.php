<?php namespace App\Http\Controllers;

use Request;
use App\Game;
use App\Playthrough;

class PlaythroughController extends Controller {

   
    public function __construct()
    {
        
    }

    public function getIndex()
    {
        return view('welcome');
    }

    public function getList(){
        $g = Playthrough::with(['players', 'game'])->get();
        return view('playthrough.list')->with(['plays' => $g]);
    }

    public function getShow($id){
        return view('game.detail')->with(['game' => Game::find($id) ]);
    }

    public function getAdd(){
        return 'nothing here';
    }

}
