@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Players<h2>
    </div>
</div>

    @foreach($players as $g)
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="flip-card">
                <div class="front" style="background: url('{{asset('people/'.$g->id.'.jpg') }}' ) no-repeat center;">
                    &nbsp;
                </div>
                <a href="{{ action('UserController@getShow', $g->id)}}">
                <div class="back">
                    <h3 class="text-center">{{ $g->name }}</h3>
                </div>
                </a>
            </div>
        </div>
    @endforeach 
     
</div>

@stop

@section('scripts')

    <script src="{{  asset('js/flip.js')}}"></script>

<script>
    $( document ).ready(function() {
        
        $(".flip-card").flip({ trigger: 'hover' })

    });
</script>

@stop