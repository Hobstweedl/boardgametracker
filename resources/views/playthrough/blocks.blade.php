<div class="row">
    @foreach($plays as $p)    
        <div class="col-md-3 col-sm-12 col-xs-12">


            <div class="flip-cardd">
                <div class="front">
                <img class="img-responsive opacity" src="{{ asset('games/'.camel_case($p->game->name).'.jpg') }}">

                    <div class="abs-pos">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h3>{{ Helper::prettyDate( $p->date_played ) }}</h3>
                                <div class="player-listing">
                                @foreach($p->players as $i)
                                    <img src="{{asset('people/'.$i->player_id.'-thumbnail.jpg') }}" class="img-circle rankings">
                                    {{ $i->score}}
                                @endforeach
                                </div>
                                <h3 class="text-center">{{ $p->notes }} </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>

<script>
    $( document ).ready(function() {
            var cards = $(".flip-cardd").find('.player-listing');

            $.each(cards, function(i, v){
                var images = $(v).find('img').length;
                console.log(images);
                console.log('end');
            })
               

    });
</script>
