@extends('template')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Games Played<h2>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                Games Played
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered">

                <thead>
                    <th>Game</th>
                    <th>Winner</th>
                    <th>Notes</th>
                    <th>Date Played</th>
                </thead>
                
                <tbody>
                    <tr>
                        <td>Gravewell</td>
                        <td>Sam Lodise</td>
                        <td>Beginner Luck</td>
                        <td>2015-04-08</td>
                    </tr>
                </tbody>
                
                </table>
            </div>
        </div>
    </div>
            
</div>
    
</div>

@stop

@section('scripts')


<script>
    $( document ).ready(function() {
        

    });
</script>

@stop