@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-gleam"></i>
                                        <div class="">
                                        <p>{{$today_log->count()}} Trucks Entered</p>
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{url('/trucks')}}">
                                        View all trucks
                                        </a>
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                   <small class="stats" style="text-transform: uppercase; font-size: 10px;">
                                        <i class="ti-timer"></i> As of today
                                  </small>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-id"></i>
                                        <div class="">
                                        <p>{{$drivers->count()}} Total Drivers</p>
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{url('/drivers')}}">
                                        View all drivers
                                        </a>
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                   <small class="stats" style="text-transform: uppercase; font-size: 10px;">
                                        <i class="ti-timer"></i> As of today
                                  </small>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-helm"></i>
                                        <div class="">
                                        <p>{{$trucks->count()}} Total Trucks</p>
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{url('/trucks')}}">
                                        View all trucks
                                        </a>
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                   <small class="stats" style="text-transform: uppercase; font-size: 10px;">
                                        <i class="ti-timer"></i> As of today
                                  </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-users"></i>
                                        <div class="">
                                        <p>0 Guest Trucks</p>
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{url('/guests')}}">
                                        View all guests
                                        </a>
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                   <small class="stats" style="text-transform: uppercase; font-size: 10px;">
                                        <i class="ti-timer"></i> As of today
                                  </small>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>



                <div class="row">
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Daily Monitoring

                                <div class="pull-right btn-group">
                                  <a href="#" class="btn btn-success">{{$all_in->count()}} still in plant</a>
                                  <a href="#" class="btn btn-warning">{{$all_out->count()}} on transit</a>
                                </div>
                                  
                                </h4>
                                <p class="category">Total trucks entered this day</p>


                            </div>
                            <div class="content table-responsive table-full-width" id="feed">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> </th>
                                    <th>Driver Name</th>
                                    <th>Plate Number</th>
                                    <th>Operator</th>
                                    <th>IN</th>
                                    <th>OUT</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($today_log as $today)
                                    <tr>   
                                        <th>
                                             <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 50px;">
                                        </th> 
                                        <td>
                                             @foreach($today->drivers as $driver)
                                                    <a href="{{url('/drivers/'.$driver->id)}}"> 
                                                    {{  $driver->name }}
                                                    </a>
                                            @endforeach 
                                        </td>
                                        <td>
                                           @foreach($today->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($today->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                            @endforeach 
                                        </td>
                                        <td>
                                        @foreach($all_in as $in)
                                            @foreach($in->drivers->where('name', '==', $driver->name) as $driver_in)
                                                    <span class="label label-success">{{  date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @endforeach 
                                        @endforeach  
                                        </td>
                                        <td>
                                        @foreach($all_out as $out)
                                            @foreach($out->drivers->where('name', '==', $driver->name) as $driver_out)
                                                    <span class="label label-warning">{{  date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                            @endforeach 
                                        @endforeach  

                                
                                        </td>

                                        <td>

                                        </td>

                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                     
                  

                            <hr/>





                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div>
@endsection
