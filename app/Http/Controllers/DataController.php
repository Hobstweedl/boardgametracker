<?php namespace App\Http\Controllers;

use Request;
use DB;
use Response;

class DataController extends Controller {

   /*
        Game totals -  Return every game played with total number of games played for it
        Game Stats - Return players that have played with times won for a single game
        Player stats -  Return games that a player has played


        Win percentage stats for a game showing all player wins
        Win percentage stats for a player showing all games won/lost?
        
   */
    public function __construct()
    {
        
    }

    public function getGamewinstats($id){

        $response = [];
        $stats = DB::table('playthroughs')->
        join('players', 'players.id', '=', 'playthroughs.player_id')->
        where('playthroughs.game_id', '=', $id)->
        groupBy('players.name')->
        get([DB::raw('count(player_id) as plays'), 'players.name']);

        foreach($stats as $stat){
            $response[] = [$stat->name, $stat->plays];
        }

        


        return Response::json($response);

    }

    public function getGamestats($id){

        $player = [];
        $response = [];
        $stats = DB::table('participants')->
        join('players', 'players.id', '=', 'participants.player_id')->
        join('games', 'games.id', '=', 'participants.game_id')->
        join('playthroughs', 'playthroughs.id', '=', 'participants.playthrough_id')->
        where('participants.game_id', '=', $id)->
        get(['participants.id', 'games.name as game_name','participants.game_id', 'participants.player_id', 'players.name as player_name', 'participants.playthrough_id', 'playthroughs.player_id as winner']);

        foreach($stats as $stat){
            if( !array_key_exists($stat->player_id, $player) ){
                $player[$stat->player_id]['count'] = 1;
                $player[$stat->player_id]['name'] = $stat->player_name;
            } else{
                $player[$stat->player_id]['count'] ++;
                
            }
        }

        foreach ($player as $p){
            $response[] = [$p['name'], $p['count'] ];
        }

        return Response::json($response);
    }

    public function getGameTotals(){

        /*
        foreach($stats as $stat){
            if( !array_key_exists($stat->playthrough_id, $playthroughs) ){
                $playthroughs[$stat->playthrough_id] = 1;
            } else{
                $playthroughs[$stat->playthrough_id] ++;
            }
        }
        */

    }

}
