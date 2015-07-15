<div class="row">

    <div class="col-md-12">
        
        <table class="table table-striped table-bordered table-hover">

        <thead>
            <th>Game</th>
            <th>Winner</th>
            <th>Notes</th>
            <th>Players</th>
            <th>Date Played</th>
        </thead>
        
        <tbody>
            @foreach($plays as $p)
                <tr class='clickable-row' data-href="{{ action('PlaythroughController@getShow', $p->id )}} ">
                    <td>{{ $p->game->name }}</td>
                    <td>{{ $p->winner->name }}</td>
                    <td>{{ $p->notes }}</td>
                    <td>
                        @foreach($p->players as $i)
                            <img src="{{asset('people/'.$i->player_id.'.jpg') }}" class="img-rounded" width="50">
                        @endforeach
                    
                    </td>
                    <td>{{ Helper::prettyDate( $p->date_played ) }}</td>
                </tr>
            @endforeach
        </tbody>
        
        </table>
           
    </div>
            
</div>