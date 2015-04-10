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
                    <select class="form-control">
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
                </div>


            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Player Details</div>
            <div class="panel-body">
                <div class="form-group" id="scores"></div>
            </div>
        </div>
    </div>
</div>

</form>

@stop

@section('scripts')

<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script>
    $( document ).ready(function() {
       $( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
    
    });
</script>

@stop