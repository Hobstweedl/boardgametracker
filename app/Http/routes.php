<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Player;
use App\Game;
use App\Playthrough;
use App\Participant;

Route::get('/', function(){
    return view('components.dashboard');
});



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('template', function(){
    return view('admin.blank');
});

Route::get('players', function(){
    $players = \App\Player::all();

    print_r($players);
});


Route::get('gameplay', function(){
    return view('gameplay')->with(['games' => Game::all(), 'players' => Player::all() ]);
});

Route::post('gameplay', function(){

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
        
        //  Functionality for scoring
        //  Need to iterate through the inputs with the scores
        //  that have come in the request

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


});

Route::controller('users', 'UserController');
Route::controller('games', 'GameController');
Route::controller('playthroughs', 'PlaythroughController');
Route::controller('data', 'DataController');

