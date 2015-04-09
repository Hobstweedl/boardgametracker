@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Players<h2>
    </div>
</div>


                   
 

    @foreach($players as $g)
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="flip-card" style="background: url('{{asset('people/'.$g->id.'.jpg') }}' ) no-repeat center; ">
                <!--<h3 class="text-center">{{ $g->name }}</h3> -->
            </div>
        </div>
    @endforeach
            
     
    
</div>

@stop