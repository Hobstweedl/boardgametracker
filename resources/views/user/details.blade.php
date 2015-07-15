@extends('template')

@section('content')

<div class="row">
    <!--<img class="img-circle" src="{{asset('people/'.$player->id.'.jpg') }}" width="80" height="70" > -->
    <div class="col-md-2">
        <h2>{{$player->name}}</h2>   
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">

        <div class="panel-heading">Edit</div>

        <div class="panel-body">

            <form method="post" enctype="multipart/form-data">        
                <div class="form-group">
                    <label>Player's Name</label>
                    <input class="form-control" name="name" value="{{$player->name}}">
                </div>

                <div class="form-group">
                    <label for="image">Upload an Image</label>
                    <input type="file" name="photo" id="file">
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                    <h4>Current Picture</h4>
                        <img src="{{asset('people/'.$player->id.'.jpg') }}" >
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12" style="background-color: #eee">
                        <h4>New Picture</h4>
                        <img class="img-responsive" id="preview" >
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="offsetx" value="0">
                <input type="hidden" name="offsety" value="0">
                <input type="hidden" name="height" value="0">
                <input type="hidden" name="width" value="0">
                
                <hr>

                <button type="submit" class="btn btn-primary">Add Player</button>
            </form>

        </div>

        </div>
    </div>
</div>

@stop

@section('charts')

<hr>
<div class="row">
    <div class="col-md-6">
        <div id="winchart"></div>
    </div>
    <div class="col-md-6">
        <div id="statchart"></div>
    </div>
</div>




@stop

@section('scripts')

<script>

google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(chartInit);

function chartInit(){
    drawWinChart();
    drawPieChart();
}

function drawWinChart(){
    var winurl = "{{ action('DataController@getPlayerwinstats' )}}/" + {{ $player->id }};
    $.getJSON( winurl, function(stats){
        console.log(stats);
    var data = new google.visualization.arrayToDataTable(stats);
    
    var options = {
        title: 'Game Plays',
        height: 800,
        width: '100%',
        colors: ['#b0120a', '#ffab91'],
        legend: { position: 'top'},
        bar: { groupWidth: '75%' },
        hAxis:{
            minValue: 0
        },
        isStacked: 'true'
    };

    var chart = new google.visualization.BarChart(document.getElementById('winchart'));
    chart.draw(data, options);
    
    //google.setOnLoadCallback(drawDualX);
    });
}

function drawPieChart(){
    var statsurl = "{{ action('DataController@getPlayerstats' )}}/" + {{ $player->id }};

    $.getJSON( statsurl, function(stats){
        var data = google.visualization.arrayToDataTable( stats);
      
        var options = {
            title: 'Game Frequency',
            pieHole: 0.4,
            height: 800
        }
        var chart = new google.visualization.PieChart(document.getElementById('statchart'));
        chart.draw(data, options);

    });
}

    $( document ).ready(function() {
  
       

        
        $( '#file' ).on( "change", function() {
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