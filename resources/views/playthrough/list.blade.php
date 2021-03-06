@extends('template')

@section('content')

<style>

.clickable-row:hover{cursor:pointer;}

</style>

<div class="row">
    <div class="col-md-12">
        <h2>Games Played<h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Views
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#blocks" data-toggle="tab">Fancy Display</a></li>
                    <li class=""><a href="#table" data-toggle="tab">Table</a></li>  
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="blocks">
                        <br>
                        @include('playthrough.blocks', ['plays' => $plays])
                    </div>
                    <div class="tab-pane fade" id="table">
                        <br>
                        @include('playthrough.table', ['plays' => $plays])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')

<script src="{{  asset('js/flip.js')}}"></script>

<script>


    $( document ).ready(function() {
        $(".flip-card").flip({ trigger: 'hover' })

         $(".clickable-row").on( "click", function() {
            //alert('year');
            var url = $(this).data("href");
            console.log(url);
            window.document.location = url;
        });

    });
</script>

@stop