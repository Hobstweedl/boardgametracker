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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

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

Route::get('wtf', function(){
	return 'wtf';
});	

Route::get('gameplay', function(){
    return view('gameplay')->with(['games' => Game::all(), 'players' => Player::all() ]);
});

Route::post('gameplay', function(){
	print_r( Request::all() );
});

Route::controller('users', 'UserController');
Route::controller('games', 'GameController');
