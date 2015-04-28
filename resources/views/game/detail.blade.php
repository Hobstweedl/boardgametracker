@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2> {{ $game->name }}</h2>   
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

        <div class="panel-heading">Edit Game Details</div>

        <div class="panel-body">

            <form method="post" enctype="multipart/form-data">        
                <div class="form-group">
                    <label>Game</label>
                    <input class="form-control" name="name" value="{{$game->name}}">
                </div>
                
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Scorable?</label>
                        @if($game->scorable == 1)
                            <input type="checkbox" class="form-control" name="score" checked value="1">
                        @else
                            <input type="checkbox" class="form-control" name="score" value="1">
                        @endif
                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Upload an Image</label>
                    <input type="file" name="photo" id="file">
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <h4>Current Picture</h4>
                        <img src="{{asset('games/'.camel_case($game->name).'.jpg') }}" height="225">
                    </div>
                    <div class="col-md-6" style="background-color: #eee">
                        <h4>New Picture</h4>
                        <img class="img-responsive" id="preview" height="225">
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="offsetx" value="0">
                <input type="hidden" name="offsety" value="0">
                <input type="hidden" name="height" value="0">
                <input type="hidden" name="width" value="0">
                
                <hr>

                <button type="submit" class="btn btn-primary">Add Game</button>
            </form>

        </div>

        </div>
    </div>
</div>

@stop

@section('charts')

<hr>

<div class="ct-chart " id="chart"></div>

@stop

@section('scripts')



<script>

    $( document ).ready(function() {

        var data = {
            labels: ['Bananas', 'Apples', 'Grapes'],
            series: [30, 60, 10]
        };

        var sum = function(a, b) { return a + b };

        var options = {
          width: 900,
          height: 900
        };

        new Chartist.Pie('.ct-chart', data, options);
        
        $( '#file' ).on( "change", function() {
            console.log('file updated');
            var fr = new FileReader();
            fr.readAsDataURL(document.getElementById("file").files[0]);

            fr.onload = function(ev){
                document.getElementById("preview").src= ev.target.result; 
                var $cropped = $('div > img#preview').cropper({
                    aspectRatio: 1 / 1,
                    strict: false,
                    guides: false,
                    highlight: false,
                    movable: true,
                    minCropBoxWidth: 400,

                    crop: function(data) {
                        console.log(data);
                        $( "input[name=offsetx]" ).val(data.x);
                        $( "input[name=offsety]" ).val(data.y);
                        $( "input[name=height]" ).val(data.height);
                        $( "input[name=width]" ).val(data.width);
                    }
                });
            }

        });
    });
</script>

@stop