@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Add A New Game Played</h2>   
    </div>
</div>

<form method="post">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">Game Details</div>

            <div class="panel-body">
        
                <div class="form-group">
                    <label>Which game did you play?</label>
                    <select name="game" class="form-control">
                        <option value="0"> Select a game</option>
                        @foreach( $games as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Who Played?</label>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <ul id="sortable1" class="connectedSortable">
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <ul id="sortable2" class="connectedSortable">
                            @foreach($players as $p)
                                <li data-id="{{$p->id}}">{{$p->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="form-group">
                    <label>Who won?</label>
                    <option value="0">Select a Winner</option>
                    <select id="winner" name="winner" class="form-control">
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row" id="scoretable">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Player Scores</div>
            <div class="panel-body">
                <div class="form-group" id="scores"></div>
            </div>
        </div>
    </div>
</div>
<div id="hidden">   </div>

<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="submit" value="add play" class="btn btn-primary">

</form>

@stop

@section('scripts')

<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script>
    $( document ).ready(function() {

        $("select[name='game']").on("change", function(){
            var game = $(this).val();
            $.get( "{{ action('GameController@getGamedata' )}}" + '/' + game, function( data ) {
                console.log( data );

                if(data.scorable == 0){
                    $("#scoretable").hide();
                } else{
                    $("#scoretable").show();
                }
            });
        });
       
        $( "#sortable1").sortable({
          cursor: "move",
          connectWith: ".connectedSortable",
          receive: function(event, u){
            var li = u.item;
            var id = $(li).data("id");
            $("#hidden").append('<input type="hidden" name="player[]" value="' 
                + id + '" class="p-' + id + '">');
            var name = li[0].firstChild.data;
            var innerhtml = '<div class="row score-input player-detail-' + id + '" > <div class="col-md-3">' + 
            '<label style="width: 200px;">' + name + '<label>' +
            '</div> <div class="col-md-6">' +
            '<input class="form-control" name="person-' + id + '">' + 
            '</div></div>'

            $("#scores").append(innerhtml)
            $("#winner").append('<option value="' + id + '">' + name + '</option>')
          },
          remove: function(event, u){
            var id = $(u.item).data("id");
            $(".p-" + id).remove();
            console.log(id);
            $('div.player-detail-' + id).remove();
            $('#winner option[value="' + id + '"]').remove();
          }
          
        }).disableSelection();

        $( "#sortable2").sortable({
          connectWith: ".connectedSortable"          
        }).disableSelection();
    
    });
</script>

@stop