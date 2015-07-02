<?php namespace App\Http\Controllers;

use Request;
use App\Player;
//use App\ImageResize;
use Image;

class UserController extends Controller {

   
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('welcome');
    }

    public function getList(){
        return view('user.list')->with(['players' => Player::all() ]);
    }

    public function getShow($id){
        return view('user.details')->with(['player' => Player::find($id) ]);
    }

    public function postShow($id){

        $player = Player::find( $id );
        $player->name = Request::input('name');
        $player->save();

        $width = round( Request::input('width'), 0);
        $height = round( Request::input('height'), 0);
        $offsetx = round( Request::input('offsetx'), 0);
        $offsety = round( Request::input('offsety'), 0);
        
        if( Request::hasFile('photo')){

            $photo = Request::file('photo');
            $d = 'people'.DIRECTORY_SEPARATOR.$player->id.'.'.$photo->getClientOriginalExtension();

            Image::make($photo)->crop(
                $width,
                $height,
                $offsetx,
                $offsety
            )->resize(400, null, function($c){
                $c->aspectRatio();
            })->save($d);

            Image::make($photo)->crop(
                $width,
                $height,
                $offsetx,
                $offsety
        )->resize(50, 50, function($c){
                $c->aspectRatio();
            })->save( 'people'.DIRECTORY_SEPARATOR.$player->id.'-thumbnail.'.$photo->getClientOriginalExtension() );
            
        }
        
        return redirect()->action('UserController@getShow', $id);

    }

    public function getAdd(){

        return view('user.add');

    }

    public function postAdd(){
        //$destination = public_path().DIRECTORY_SEPARATOR .'people'.DIRECTORY_SEPARATOR ;

        
        $player = new Player;
        $player->name = Request::input('name');
        $player->save();

        $width = round( Request::input('width'), 0);
        $height = round( Request::input('height'), 0);
        $offsetx = round( Request::input('offsetx'), 0);
        $offsety = round( Request::input('offsety'), 0);
        
        
        if( Request::hasFile('photo')){

            $photo = Request::file('photo');
            $d = 'people'.DIRECTORY_SEPARATOR.$player->id.'.'.$photo->getClientOriginalExtension();

            //$photo->move($destination,$player->id.'.'.$photo->getClientOriginalExtension() );
            //$filename = $destination.$player->id.'.'.$photo->getClientOriginalExtension();

            Image::make($photo)->crop(
                $width,
                $height,
                $offsetx,
                $offsety
            )->resize(400, null, function($c){
                $c->aspectRatio();
            })->save($d);

            Image::make($photo)->crop(
                $width,
                $height,
                $offsetx,
                $offsety
        )->resize(50, 50, function($c){
                $c->aspectRatio();
            })->save( 'people'.DIRECTORY_SEPARATOR.$player->id.'-thumbnail.'.$photo->getClientOriginalExtension() );
            
            /*$image = new ImageResize( $filename );
            $image->resizeToWidth(370);
            $image->save('people/'.$player->id.'.jpg', IMAGETYPE_JPEG);
            */
        }

        return redirect()->action('UserController@getList');
        
    }

}
