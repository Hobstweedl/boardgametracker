<?php namespace App\Http\Controllers;

use Request;
use DB;
use Response;

class DataController extends Controller {

   /*
        Game totals -  Return every game played with total number of games played for it
        Game Stats - Return players that have played with times won for a single game
        Game Win Stats - Return number of times player has won a game
        Player stats -  Return games that a player has played


        Win percentage stats for a game showing all player wins
        Win percentage stats for a player showing all games won/lost?
        
   */
    public function __construct()
    {
        
    }

    public function getPlayerwinstats($id){
        $response = [];
        $stats = DB::select('select g.name as name, count(p.player_id) as count 
                            from playthroughs p inner join games g on g.id =  p.game_id
                            where p.player_id = ?
                            group by g.name', [$id]);

        foreach($stats as $s){
            $response[] = [$s->name, (int) $s->count];
        }

        return Response::json( $response );
    }

    public function getPlayerstats($id){
        $response = [];
        $stats = DB::select('select g.name as name, count(p.playthrough_id) as count
                            from participants p
                            inner join games g on p.game_id = g.id
                            where p.player_id = ?
                            group by g.name', [$id]);

        foreach($stats as $s){
            $response[] = [$s->name, (int) $s->count];
        }

        return Response::json( $response );
    }

    public function getGamewinstats($id){

        $response = [];
        $stats = DB::table('playthroughs')->
        join('players', 'players.id', '=', 'playthroughs.player_id')->
        where('playthroughs.game_id', '=', $id)->
        groupBy('players.name')->
        get([DB::raw('count(player_id) as plays'), 'players.name']);

        foreach($stats as $stat){
            $response[] = [$stat->name, (int) $stat->plays];
        }

        return Response::json($response);

    }

    public function getGamestats($id){
        $player = [];
        $response = [];
        $stats = DB::select('select pl.name as name, count(p.playthrough_id) as count
                            from participants p
                            inner join players pl on p.player_id = pl.id
                            where p.game_id = ?
                            group by pl.name', [$id]);

        foreach($stats as $s){
            $response[] = [$s->name, (int) $s->count];
        }

        return Response::json( $response );
    }

}
