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
                    <li class="active"><a href="#table" data-toggle="tab">Table Display</a></li>
                    <li class=""><a href="#blocks" data-toggle="tab">Fancy</a></li>  
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="table">
                        <br>
                        @include('playthrough.table', ['plays' => $plays])
                    </div>
                    <div class="tab-pane fade" id="blocks">
                        <br>
                        @include('playthrough.blocks', ['plays' => $plays])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')


<script>
    $( document ).ready(function() {
         $(".clickable-row").click(function() {
            window.document.location = $(this).data("href");
        });

    });
</script>

@stop