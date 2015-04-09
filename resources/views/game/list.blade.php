@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Games<h2>
    </div>
</div>


                   
 

    @foreach($games as $g)
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div 
            style="background: url('{{asset('games/'.camel_case($g->name).'.jpg') }}' ) no-repeat center; height: 400px; background-size:100%;">
                <!--<h3 class="text-center">{{ $g->name }}</h3> -->
            </div>
        </div>
    @endforeach
            
     
    
</div>

@stop