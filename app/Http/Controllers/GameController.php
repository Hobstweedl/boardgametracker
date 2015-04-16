<?php namespace App\Http\Controllers;

use Request;
use App\Game;
use App\ImageResize;

class GameController extends Controller {

   
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('welcome');
    }

    public function getList(){
        return view('game.list')->with(['games' => Game::all() ]);
    }

    public function getShow($id){
        return view('game.detail')->with(['game' => Game::find($id) ]);
    }

    public function postShow($id){
        print_r( Request::all() );
        $game = Game::find($id);
        $game->name = Request::input('name');

        if(Request::has('score')){
            $game->scorable = 1;
        } else{
            $game->scorable = 0;
        }
        $game->save();

        return redirect()->action('GameController@getShow', $id);
    }


    public function getAdd(){

        return view('game.add');

    }

    public function postAdd(){
        $destination = public_path().DIRECTORY_SEPARATOR .'games'.DIRECTORY_SEPARATOR ;
    
        $game = new Game;
        $game->name = Request::input('name');
        $game->save();
        
        if( Request::hasFile('photo')){
            $photo = Request::file('photo');
            $photo->move($destination,camel_case($game->name).'.'.$photo->getClientOriginalExtension() );
            $filename = $destination.camel_case($game->name).'.'.$photo->getClientOriginalExtension();

            $image = new ImageResize( $filename );
            $image->resizeToWidth(400);
            $image->save('games/'.$game->name.'.jpg', IMAGETYPE_JPEG);
        }

        return redirect()->action('GameController@getList');
    }

    public function getGamedata($id){
        $game = Game::find($id);

        return response()->json($game);
    }

}
