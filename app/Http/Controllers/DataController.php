<?php namespace App\Http\Controllers;

use Request;
use DB;
use Response;
use File;

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
        $data = [];
        $cat = ['name' => 'Games'];
        $plays = ['name' => 'Losses'];
        $wins = ['name' => 'Wins'];
       $stats = DB::select(DB::raw('
                   SELECT
       cast(SUM(CASE
       WHEN pt.player_id IS NULL THEN 0
              ELSE 1
       END) AS UNSIGNED) AS wins,
          COUNT(pr.player_id) AS plays,
          g.name,
          g.id
       FROM
       participants pr
       LEFT JOIN playthroughs pt ON (pr.playthrough_id = pt.id AND pr.player_id = pt.player_id)
       INNER JOIN games g ON (pr.game_id = g.id)
       WHERE pr.player_id = ?
       GROUP BY g.id, g.name'), [$id]);


               foreach($stats as $s){
                $cat['data'][] = $s->name;
                $plays['data'][] = $s->plays;
                $wins['data'][] = $s->wins;
               }
               array_push($data, $cat);
               array_push($data, $plays);
               array_push($data, $wins);

               $myjson = json_encode($data);
               $bytes = File::put('api.json', $myjson);

               return Response::json( $data );
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


/*******************************/
 


    public function getGamewinstats($id){

         $data = [];
        $cat = ['name' => 'Players'];
        $plays = ['name' => 'Losses'];
        $wins = ['name' => 'Wins'];
       $stats = DB::select(DB::raw('
                    SELECT
       cast(SUM(CASE
       WHEN pt.player_id IS NULL THEN 0
              ELSE 1
       END) AS UNSIGNED) AS wins,
          COUNT(pr.player_id) AS plays,
          p.name,
          p.id
       FROM
       participants pr
       LEFT JOIN playthroughs pt ON (pr.playthrough_id = pt.id AND pr.player_id = pt.player_id)
       INNER JOIN players p ON (pr.player_id = p.id)
       WHERE pr.game_id = ?
       GROUP BY p.id, p.name'), [$id]);


               foreach($stats as $s){
                $cat['data'][] = $s->name;
                $plays['data'][] = $s->plays;
                $wins['data'][] = $s->wins;
               }
               array_push($data, $cat);
               array_push($data, $plays);
               array_push($data, $wins);

               return Response::json( $data );

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

    public function getTotalWins(){
        $stats = DB::select('
            select count(pl.id) as wins, p.name from playthroughs pl 
            join players p on p.id = pl.player_id
            group by pl.player_id 
            order by yeah desc
        ');

        return Response::json($stats);
    }

}
