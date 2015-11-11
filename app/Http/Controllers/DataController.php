<?php namespace App\Http\Controllers;

use Request;
use DB;
use Response;
use File;

class DataController extends Controller {

    public function __construct()
    {
        
    }

    public function getPlayerwinstats($id){
      $data = [['Games', 'Wins', 'Losses']];
    
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
                $data[] = [$s->name, (int) $s->wins, (int) ($s->plays - $s->wins)];
               }

               return Response::json( $data );
    }

    public function getPlayerstats($id){
        $response = [['Game', 'Plays']];
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

      $data = [['Games', 'Wins', 'Losses']];
    
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
        $data[] = [$s->name, (int) $s->wins, (int) ($s->plays - $s->wins)];
      }

      return Response::json( $data );

    }

    public function getGamestats($id){
        $response = [['Player', 'Plays']];

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
            order by p.name desc
        ');

        return Response::json($stats);
    }

    public function getStatdayofweekbyplayer(){
      //  here

      $stats = DB::select("
          SELECT
              player_id, name, MAX(count_of_days) AS wins, day_of_week
          FROM
              (SELECT
                  pt.player_id,
                      p.name,
                      COUNT(pt.player_id) AS count_of_days,
                      CASE DAYOFWEEK(pt.date_played)
                          WHEN 1 THEN 'Sunday'
                          WHEN 2 THEN 'Monday'
                          WHEN 3 THEN 'Tuesday'
                          WHEN 4 THEN 'Wednesday'
                          WHEN 5 THEN 'Thursday'
                          WHEN 6 THEN 'Friday'
                          WHEN 7 THEN 'Saturday'
                      END AS day_of_week
              FROM
                  playthroughs pt
              INNER JOIN players p ON pt.player_id = p.id
              GROUP BY pt.player_id , p.name , day_of_week
              ORDER BY count_of_days DESC) sq1
          GROUP BY player_id , name
          ORDER BY wins DESC
        ");

      return Response::json($stats);
    }

    public function getStatoverallwin(){

      $stats = DB::select("
        SELECT
            ROUND((SUM(CASE
                        WHEN pt.player_id IS NULL THEN 0
                        ELSE 1
                    END) / COUNT(pr.player_id)) * 100,
                    2) AS win_pct,
            pl.name,
            pl.id,
            COUNT(pr.player_id) AS plays,
            COUNT(pt.player_id) AS wins
        FROM
            participants pr
                LEFT JOIN
            playthroughs pt ON (pr.playthrough_id = pt.id
                AND pr.player_id = pt.player_id)
                INNER JOIN
            playthroughs pt1 ON pr.playthrough_id = pt1.id
                INNER JOIN
            players pl ON (pr.player_id = pl.id)
        WHERE
            pt1.game_id <> 22
        GROUP BY pl.id , pl.name
        ORDER BY win_pct DESC
      ");
      return Response::json($stats);

    }

    public function getStattoptengamesplayed(){

      $stats = DB::select("
        SELECT
            COUNT(pt.id) AS plays, g.name
        FROM
            playthroughs pt
                INNER JOIN
            games g ON pt.game_id = g.id
        GROUP BY g.name
        ORDER BY COUNT(pt.id) DESC , pt.date_played DESC
        LIMIT 0 , 10
      ");
      return Response::json($stats);

    }

    public function getStattopwinningpercentages(){

      $stats = DB::select("
        SELECT
            ROUND((SUM(CASE
                        WHEN pt.player_id IS NULL THEN 0
                        ELSE 1
                    END) / COUNT(pr.player_id)) * 100,
                    2) AS win_pct,
            pl.name,
            pl.id,
            COUNT(pr.player_id) AS plays,
            COUNT(pt.player_id) AS wins
        FROM
            participants pr
                LEFT JOIN
            playthroughs pt ON (pr.playthrough_id = pt.id
                AND pr.player_id = pt.player_id
                AND pt.date_played >= DATE_ADD(NOW(), INTERVAL - 5 MONTH))
                INNER JOIN
            playthroughs pt1 ON pr.playthrough_id = pt1.id
                INNER JOIN
            players pl ON (pr.player_id = pl.id)
        WHERE
            (pt1.date_played >= DATE_ADD(NOW(), INTERVAL - 5 MONTH))
                AND pt1.game_id <> 22
        GROUP BY pl.id , pl.name
        HAVING COUNT(pr.player_id) >= 3
        ORDER BY win_pct DESC
      ");

      print_r($stats);

      foreach( $stats as $p){
        $link = asset('people/'.$p->id.'.jpg');
        echo $link;
        echo '<img src="'. $link.'">';

        echo 'hello world </div>';
      }

    }

}
