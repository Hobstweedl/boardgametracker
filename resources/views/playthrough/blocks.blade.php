<div class="row">
    @foreach($plays as $p)    
        <div class="col-md-3 col-sm-12 col-xs-12">


            <div class="flip-card">
                <div class="front">
                <img class="img-responsive opacity" src="{{ asset('games/'.camel_case($p->game->name).'.jpg') }}">

                    <div class="abs-pos">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <img src="{{asset('people/'.$p->winner->id.'.jpg') }}" class="img-circle winner-profile">
                                <h3>{{ Helper::prettyDate( $p->date_played ) }}</h3>
                                @foreach($p->players as $i)
                                    <img src="{{asset('people/'.$i->player_id.'-thumbnail.jpg') }}" class="img-circle" width="50" height="50">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="back">
                    <div class="col-md-12 player-score" style="margin-top: 30px;">
                        @foreach($p->players as $i)
                        <p>{{ $i->name }} - {{ $i->score }}</p>
                        @endforeach
                        <h3 class="text-center">{{ $p->notes }} </h3>
                    </div>
                    
                </div>
            </div>
        </div>

    @endforeach
</div>
