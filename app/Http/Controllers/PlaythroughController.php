<?php namespace App\Http\Controllers;

use Request;
use App\Game;
use App\Player;
use App\Playthrough;
use App\Participant;

class PlaythroughController extends Controller {

   
    public function __construct()
    {
        
    }

    public function getIndex()
    {
        return view('welcome');
    }

    public function getList(){
        $g = Playthrough::with(['players', 'game', 'winner'])->get();
        return view('playthrough.list')->with(['plays' => $g]);
    }

    public function getShow($id){
        $play = Playthrough::with(['players', 'game', 'winner'])->find($id);
        return view('playthrough.detail')->with(['play' => $play ]);
    }

    public function getAdd(){
        return view('gameplay')->with(['games' => Game::all(), 'players' => Player::all() ]);
    }

    public function postAdd(){

        $dt = strtotime(Request::input('date') );

        $game = Game::find( Request::input('game') );

        $p = new Playthrough;
        $p->date_played = date("Y-m-d", $dt);
        $p->notes = Request::input('notes');
        $p->player_id = Request::input('winner');
        $p->game_id = $game->id;
        $p->save();

        $playthrough_id = $p->id;

        $players = Request::input('player');

        if($game->scorable == 1){


            foreach($players as $player){
                $newplayer = Participant::create([
                    'game_id' => $game->id,
                    'player_id' => $player,
                    'playthrough_id' => $playthrough_id,
                    'score' => Request::input('person-'.$player)

                ]);
            }

        } else{
            foreach($players as $player){
                $newplayer = Participant::create([
                    'game_id' => $game->id,
                    'player_id' => $player,
                    'playthrough_id' => $playthrough_id
                ]);
                
            }
        }
        
        return redirect()->action('GameController@getList');


    }

}
