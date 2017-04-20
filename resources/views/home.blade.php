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
                                        <p>{{$total_today->count()}} Trucks Entered</p>
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
                                  <a href="{{url('/plant-in')}}" class="btn btn-success">{{$total_in->count()}} still in plant</a>
                                  <a href="{{url('/plant-out')}}" class="btn btn-warning">{{$all_out->count()}} on transit</a>
                                  <a href="{{url('/plant-out')}}" class="btn btn-danger">0 overtime trucks</a>
                                </div>
                                  
                                </h4>
                                <p class="category">Total trucks entered this day</p>


                            </div>
                            <div class="content table-responsive table-full-width" id="feed">

                            <table class="table ">
                                <thead>
                                <tr>
                                    <th> </th>
                                    <th>Driver Name</th>
                                    <th>Plate Number</th>
                                    <th>Operator</th>
                                    <th>IN</th>
                                    <th>OUT</th>
                                </tr>
                                </thead>
                                <tbody>




                                 @foreach($today_log as $today)
                                <tr>
                                    <td rowspan="3">
                                      <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="display:block; margin: 10px auto; width: 100px; height: auto;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="row">
                                    <div class="col-md-6">
                                     <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">Driver Name</span><br/>
                                     @foreach($today->drivers as $driver)
                                                    <a href="{{url('/drivers/'.$driver->id)}}"> 
                                                    {{  $driver->name }}
                                                    </a>
                                            @endforeach 
                                    </div>
                                    <div class="col-md-6">
                                    <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">Plate Number</span><br/>
                                    @foreach($today->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                    </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                    <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">Operator</span><br/>
                                      @foreach($today->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                            @endforeach 
                                    </div>
                                    </div>
                                    </div>
                                   

                                    
                                    </td>
                                    <td rowspan="3" colspan="2" width="20%">
                                      {{-- <div style="height: 150px; width: auto; background-color: green;"></div> --}}
                                    <a href="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($today->LocalTime))}}.0000{{$today->LogID}}-2.jpg" data-lightbox="{{$today->LogID}}" data-title="My caption">
                                    <img class="img-responsive" src="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($today->LocalTime))}}.0000{{$today->LogID}}-2.jpg">
                                    </a>
                                    </td>
                                    <td rowspan="3" colspan="2" width="20%">
                                      {{-- <div style="height: 150px; width: auto; background-color: yellow;"></div> --}}
                                      <a href="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($today->LocalTime))}}.0000{{$today->LogID}}-1.jpg" data-lightbox="{{$today->LogID}}" data-title="My caption">
                                      <img class="img-responsive" src="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($today->LocalTime))}}.0000{{$today->LogID}}-1.jpg">  
                                      </a>    
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">IN</span><br/>
                                             @foreach($all_in as $in)
                                            @foreach($in->drivers->where('name', '==', $driver->name) as $driver_in)
                                                    <span class="label label-success">{{  date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @endforeach 
                                        @endforeach 
                                            
                                        </div>
                                        <div class="col-md-6">
                                        <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">OUT</span><br/>
                                            @foreach($all_out as $out)
                                            @foreach($out->drivers->where('name', '==', $driver->name) as $driver_out)
                                                    <span class="label label-warning">{{  date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                            @endforeach 
                                        @endforeach 
                                        </div>
                                    </div>
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
