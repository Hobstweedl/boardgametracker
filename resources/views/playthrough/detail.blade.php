@extends('template')

@section('content')

<div class="row">
    <div class="col-md-2">
        <h2>{{$play->game->name}}</h2>   
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">

        <div class="panel-heading">Playthrough Details</div>

        <div class="panel-body">


        </div>

        </div>
    </div>
</div>

@stop

@section('scripts')

<script>
    $( document ).ready(function() {

    });
</script>

@stop