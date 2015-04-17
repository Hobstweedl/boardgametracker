<div class="row">
    @foreach($plays as $p)    
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="box-card">
                <div class="front" style=" width: 301px; height: 301px; background: url('{{asset('games/'.camel_case($p->game->name).'.jpg') }}' ) no-repeat; background-size: 100%;">
                    
                    &nbsp;
                </div>

                <div class="back abs-pos">
                    @foreach($p->players as $i)
                        <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-circle" width="50">
                    @endforeach
                </div>
            </div>
        </div>

    @endforeach
</div>