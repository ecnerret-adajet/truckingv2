<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

        <table class="table table-hover">
                <thead>
                <tr>
                <th>Hauler</th>
                <th>Driver</th>
                <th>Plate Number</th>

                @foreach($top_header as $header)                                
                <th>
                    {{ $header }}
                </th>
                @endforeach

                </tr>
                </thead>

                <tbody>
                    @foreach($today_result as $today)
                    @foreach($today->drivers as $driver)
                    @foreach($driver->haulers as $hauler)

                    <tr>
                            <td>
                                {{$hauler->name}}
                            </td>

                            <td>
                                {{$driver->name}}
                            </td>

                            <td>
                            @foreach($driver->trucks as $truck)
                                {{$truck->plate_number}}
                            @endforeach
                            </td>

                            @foreach($result_array as $result) 
                            <td>     
                                @forelse(App\Log::where('CardholderID',$today->CardholderID)
                                ->whereDate('LocalTime' ,Carbon\Carbon::parse($result))->get()
                                 as $value => $trip)
                                    @if($value == 0)
                                            @if(empty($trip->monitors()->count()))
                                        HAS TRIP
                                            @else

                                            @foreach($trip->monitors as $monitor)
                                            STATUS UPDATED
                                            @endforeach
                                            @endif
                                    @endif
                                @empty
                                NO TRIP
                                @endforelse
                            </td>
                            @endforeach

                        

                    </tr>
                </tbody>

                    @endforeach
                    @endforeach
                    @endforeach
            </table>

</html>