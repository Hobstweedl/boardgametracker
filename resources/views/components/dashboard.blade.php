@extends('template')

@section('charts')

<hr>

<div class="row">
    <div class="col-md-6">
        <div id="bestday"></div>
    </div>
    <div class="col-md-6">
        <div id="overallwinning"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div id="topten"></div>
    </div>
    <div class="col-md-6">
        <div id="topwinning"></div>
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
</script>
@stop