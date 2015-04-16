<div class="row">
    @foreach($plays as $p)
    
        <div class="col-md-3">
            <div class="flip-card">
                <div class="front" style="">
                    @foreach($p->players as $i)
                        <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-circle" width="50">
                    @endforeach
                </div>
                <a href="#">
                <div class="back">
                    <h3 class="text-center">{{ $p->game->name }}</h3>
                </div>
                </a>
            </div>
        </div>

    @endforeach
</div>