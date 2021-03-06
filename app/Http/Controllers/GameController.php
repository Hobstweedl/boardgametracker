<?php namespace App\Http\Controllers;

use Request;
use App\Game;
use Image;

class GameController extends Controller {

   
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('welcome');
    }

    public function getList(){
        return view('game.list')->with(['games' => Game::orderBy('name', 'asc')->get() ]);
    }

    public function getShow($id){
        return view('game.detail')->with(['game' => Game::find($id) ]);
    }

    public function postShow($id){
        $game = Game::find($id);
        $game->name = Request::input('name');

        $width = round( Request::input('width'), 0);
        $height = round( Request::input('height'), 0);
        $offsetx = round( Request::input('offsetx'), 0);
        $offsety = round( Request::input('offsety'), 0);

        if(Request::has('score')){
            $game->scorable = 1;
        } else{
            $game->scorable = 0;
        }
        $game->save();

        if( Request::hasFile('photo')){

            $photo = Request::file('photo');
            $d = 'games'.DIRECTORY_SEPARATOR.camel_case(Request::input('name')).'.jpg';

            Image::make($photo)->crop(
                $width,
                $height,
                $offsetx,
                $offsety
            )->resize(400, null, function($c){
                $c->aspectRatio();
            })->save($d);
            
        }

        return redirect()->action('GameController@getShow', $id);
    }


    public function getAdd(){

        return view('game.add');

    }

    public function postAdd(){

        $width = round( Request::input('width'), 0);
        $height = round( Request::input('height'), 0);
        $offsetx = round( Request::input('offsetx'), 0);
        $offsety = round( Request::input('offsety'), 0);
    
        $game = new Game;
        $game->name = Request::input('name');
        if(Request::has('score')){
            $game->scorable = 1;
        } else{
            $game->scorable = 0;
        }
        $game->save();
        
        if( Request::hasFile('photo')){
            $photo = Request::file('photo');
            $d = 'games'.DIRECTORY_SEPARATOR.camel_case(Request::input('name')).'.jpg';

            Image::make($photo)->crop(
                $width,
                $height,
                $offsetx,
                $offsety
            )->resize(400, null, function($c){
                $c->aspectRatio();
            })->save($d);
        }

        return redirect()->action('GameController@getList');
    }

    public function getGamedata($id){
        $game = Game::find($id);

        return response()->json($game);
    }

}
