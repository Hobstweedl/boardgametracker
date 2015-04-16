@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Game Details</h2>   
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

        <div class="panel-heading">Add New Game</div>

        <div class="panel-body">

            <form method="post" enctype="multipart/form-data">        
                <div class="form-group">
                    <label>Game</label>
                    <input class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label>Scorable?</label>
                    <input type="checkbox" class="form-control" name="score" value="1">
                </div>

                <div class="form-group">
                    <label for="image">Upload an Image</label>
                    <input type="file" name="photo">
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-primary">Add Game</button>
            </form>

        </div>

        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        


    });
</script>

@stop