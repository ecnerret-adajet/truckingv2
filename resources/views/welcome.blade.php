@extends('layouts.app')
@section('content')

<div class="row">

    @foreach($logs as $log)

            @foreach($log->drivers as $driver)
                
                {{$log->CardholderID}} - {{$driver->cardholder->Name}} </br>


            @endforeach
    @endforeach

</div>

@endsection