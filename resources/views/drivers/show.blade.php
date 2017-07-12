@extends('layouts.app')

@section('content')
           <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default" style="border-radius: 0">
                          <div class="panel-heading ">
                           <h5 class="info-header">Driver Information
                            @role(('Administrator'))
                                <a class="btn btn-primary btn-fill btn-sm pull-right" href="{{url('/drivers/'.$driver->id.'/edit')}}">          
                                 Edit Driver
                                </a>
                            @endrole
                           </h5>  
                       
                          </div>
                          <div class="panel-body driver-info-body">
                                    <div class="row">
                                            <div class="col-md-5" style="border-right: 1px solid #ccc;">
                                                    <div class="row" style="padding: 15px;">
                                                    <div class="col-md-5">
                                                        <img class="img-responsive" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}">
                                                    </div>
                                                    <div class="col-md-7">
                                                    <span class="info-title">Name</span>
                                                        <p>{{$driver->name}}</p>
                                                    <span class="info-title">Phone</span>
                                                        <p>{{$driver->phone_number}}</p>
                                                    </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-7">
                                            <div class="row" style="padding: 15px;">
                                                <div class="col-md-3">
                                                    <span class="info-title">Plate Number</span>
                                                    <p>
                                                        @foreach($driver->trucks as $truck)
                                                         {{$truck->plate_number}}
                                                       @endforeach
                                                    </p>
                                                </div>
                                                <div class="col-md-3">
                                                     <span class="info-title">Driver Status</span>
                                                    <p>
                                                        ACTIVE
                                                    </p>
                                                </div>
                                                <div class="col-md-3">
                                                     <span class="info-title">Operator</span>
                                                    <p>
                                                @foreach($driver->haulers as $hauler)
                                                {{$hauler->name}}
                                                @endforeach
                                                    </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="info-title">Total Trips</span>
                                                    <p>{{$logs->count()}}</p>
                                                </div>
                                            </div>
                                            <div class="row" style="padding: 15px;">
                                                <div class="col-md-12">
                                                     <span class="info-title">Address</span>
                                                    <p></p>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                          </div>
                        </div>
                    </div>
                </div>


                <div class="row">  
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="panel panel-default" style="border-radius: 0">
                          <div class="panel-heading">
                           <h5 class="info-header">Driver logs
                            @role(('Administrator'))
                            <a class="btn btn-primary pull-right btn-fill btn-sm" href="{{ url('/transfers/create/'.$driver->id) }}">
                                Re-assign Truck
                            </a>
                            @endrole
                           </h5>  
                       
                          </div>
                          <div class="panel-body driver-info-body">

                             <table class="table table-striped">
                                     <thead>
                                        <th>LogID</th>
                                        <th>Plate Number</th>
                                        <th>Cardholder #</th>
                                        <th>Direction</th>
                                        <th>Time</th>
                                        <th>Customer</th>
                                    </thead>
                                    <tbody>


                                    @foreach($logs  as $log)
                                        <tr>
                                            <td>{{$log->LogID}}</td>
                                            <td>
                                            @foreach($log->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach  
                                            </td>
                                            <td>
                                           @foreach($log->drivers as $driver)
                                            {{$driver->cardholder_id}}
                                           @endforeach
                                            </td>
                                            <td>
                                           {{ $log->Direction == 1 ? 'IN' : 'OUT' }}
                                            </td>
                                            <td>
                                         {{  date('Y-m-d h:i:s A', strtotime($log->LocalTime))}}
                                            </td>
                                            <td>
                                              @foreach($log->customers as $customer)
                                                {{$customer->name}}
                                              @endforeach
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
