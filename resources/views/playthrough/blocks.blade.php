<div class="row">
    @foreach($plays as $p)    
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="card">
                <div class="banner text-center">
                    {{ Helper::prettyDate( $p->date_played ) }}
                </div>


                <div class="game-tile" style="height: 360px; width: 100%; background-image: url('{{ asset('games/'.camel_case($p->game->name).'.jpg') }}') ">

                <?php $playercount = count($p->players); ?>

                    <div class="banner banner-bottom">
                        @foreach($p->players as $k => $i)

                            @if( $k == 0 )
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div style="background-image: url('{{asset('people/'.$i->player_id.'.jpg') }}' " class="img-circle rankings rank-1">
                                        
                                    </div>
                                        <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-circle rankings rank-1">
                                        <div class="score score-1">{{ $i->score }}</div>

                                    </div>
                                </div>
                                
                            @elseif( $k == 1 )
                                    @if($playercount >= 3)
                                    <div class="row">
                                    @endif
                                    <div class="col-md-6 text-center">
                                        <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-circle rankings rank-2">
                                        <div class="score score-2">{{ $i->score }}</div>
                                    </div>
                                
                                
                            @elseif( $k == 2 )
                                        <div class="col-md-6 text-center">
                                            <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-circle rankings rank-3">
                                            <div class="score score-3">{{ $i->score }}</div>
                                        </div>
                                            @if($playercount >= 3)
                                                </div>
                                            @endif

                                
                            
                            @else
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-circle rankings">
                                        <div class="score">{{ $i->score }}</div>
                                    </div>
                                </div>
                                
                            @endif
                            
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    @endforeach
</div>

<script>
    $( document ).ready(function() {
            
            $( "img.rankings" ).on({
              mouseenter: function() {

                 //var score = $(this).siblings('.score').show();
              }, mouseleave: function() {

                 //var score = $(this).siblings('.score').hide();
              }
            });
            
            
    });
</script>
