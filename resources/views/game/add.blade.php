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
                    <input type="file" name="photo" id="file">
                </div>

                <div class="form-group">
                    <img class="img-responsive" id="preview" >
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="offsetx" value="0">
                <input type="hidden" name="offsety" value="0">
                <input type="hidden" name="height" value="0">
                <input type="hidden" name="width" value="0">

                <button type="submit" class="btn btn-primary">Add Game</button>
            </form>

        </div>

        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
            
        $( '#file' ).on( "change", function() {
            var fr = new FileReader();
            fr.readAsDataURL(document.getElementById("file").files[0]);

            fr.onload = function(ev){
                document.getElementById("preview").src= ev.target.result; 
                var $cropped = $('div > img').cropper({
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