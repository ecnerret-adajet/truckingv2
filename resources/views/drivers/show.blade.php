@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">                
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <div class="row">
                                <div class="col-md-2">
                                     <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 80px;">
                                </div>

                                <div class="col-md-10">
                                <div class="row">
                                <div class="col-md-6">
                                    {{$driver->name}}
                                </div>
                                <div class="col-md-6">
                                TOTAL TRIPS:  {{$unique_log->count()}}
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    @foreach($driver->trucks as $truck)
                                        {{$truck->plate_number}}
                                    @endforeach
                                    </div>
                                    <div class="col-md-6">
                                    STATUS:
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                     @foreach($driver->haulers as $hauler)
                                        {{$hauler->name}}
                                    @endforeach                                
                                    </div>
                                </div>
                                </div>
                                </div>

                            </div>

                            <div class="content table-responsive table-full-width" id="feed">
                            <hr/>

                             <table class="table table-striped">
                                     <thead>
                                        <th>Plate Number</th>
                                        <th>Direction</th>
                                        <th>Time</th>
                                    </thead>
                                    <tbody>


                                    @foreach($logs  as $log)
                                        <tr>
                                            <td>
                                            @foreach($log->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach  
                                            </td>
                                            <td>
                                           {{ $log->Direction == 1 ? 'IN' : 'OUT' }}
                                            </td>
                                            <td>
                                         {{  date('Y-m-d h:i:s A', strtotime($log->LocalTime))}}
                                            </td>
                                        </tr>
                                    @endforeach



                                    </tbody>
                             </table>










                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>
@endsection
