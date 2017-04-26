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
                                        <a class="btn btn-primary btn-sm" href="{{url('/overtime')}}">
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
                                  <a href="{{url('/plant-in')}}" class="btn btn-success"> Time in plant</a>
                                  <a href="{{url('/plant-out')}}" class="btn btn-warning"> Time out plant</a>
                                  <a href="{{url('/overtime')}}" class="btn btn-danger">Report Entries</a>
                                </div>
                                  
                                </h4>
                                <p class="category">Total trucks entered this day</p>


                            </div>
                            <div class="content table-responsive table-full-width" id="feed">

                            <table class="table ">
                                <thead>
                                <tr>
                                    <th colspan="3">Driver Information</th>
                              
                                    <th>IN</th>
                                    <th>OUT</th>
                                </tr>
                                </thead>
                                <tbody>




                                 @foreach($today_log as $today)
                                <tr>
                                    <td rowspan="4">
            
            
                                    @foreach($today->drivers as $driver)
                                    <img class="img-responsive img-circle" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}" style="display:block; margin: 10px auto; width: 100px; height: auto;">
                                    @endforeach


                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="row">
                                    <div class="col-md-6">
                                     <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">Driver Name </span><br/>
                                     
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
                                   

                                    
                                    <td rowspan="3" colspan="2" width="20%">


                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                       
                                            <a href="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($in->LocalTime))}}.0000{{$in->LogID}}-1.jpg" data-lightbox="{{$today->LogID}}" data-title="{{$driver->name}} - TIME IN - {{  date('Y-m-d h:i:s A', strtotime($in->LocalTime))}}">
                                                <img class="img-responsive" src="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($in->LocalTime))}}.0000{{$in->LogID}}-1.jpg">
                                                </a>


                                        @empty
                                             @forelse($all_in_2->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                                <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @empty
                                               <i class="pe-7s-timer"></i>
                                       <p>NO TIME IN</p>
                                       
                                       </div> 
                                            @endforelse  
                                        @endforelse 


                                    </td>
                                    <td rowspan="3" colspan="2" width="20%">



                                        @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)

                                        
                                                <a href="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($out->LocalTime))}}.0000{{$out->LogID}}-2.jpg" data-lightbox="{{$today->LogID}}" data-title="{{$driver->name}} - TIME OUT - {{  date('Y-m-d h:i:s A', strtotime($out->LocalTime))}}">
                                                <img class="img-responsive" src="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($out->LocalTime))}}.0000{{$out->LogID}}-2.jpg">
                                                </a>

                                        @empty

                                        <div class="no-capture">

                                       <i class="pe-7s-timer"></i>
                                       <p>NO TIME OUT</p>
                                       
                                       </div> 


                                        @endforelse 

                                    </td>







                                </tr>
                                 <tr>
                                    <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">IN</span><br/>

                                           



                                    <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                            <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                        @empty
                                             @forelse($all_in_2->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                                <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @empty
                                                NO IN
                                            @endforelse  
                                        @endforelse    


                                     

                                            
                                        </div>
                                        <div class="col-md-6">
                                        <?php $final_out = ''; ?>
                                        <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">OUT</span><br/>
                                            @foreach($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                                                    @if( contains(date('Y-m-d h:i:s A', strtotime($out->LocalTime)), 'AM' ))


                                                    <span class="label label-warning">{{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                       
                                                    @endif


                                             @endforeach 
                                        </div>
                                    </div>
                                    </td>
                                    
                          
                                </tr>
                                <tr>
                                <td>

                                      <div class="row">
                                    <div class="col-md-12">
                                    <span style="text-transform: uppercase; font-size: 13ppx; color: #c5c5c5;">TIME BETWEEN</span><br/>
                                      @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out )
                                         	@forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in )
                                       			{{  $in->LocalTime->diffInHours($out->LocalTime)}} Hour(s)
                                       		@empty
                                       			NO PAIRED TIME IN
                                       		@endforelse
                                         @empty
			                                  NO PAIRED TIME OUT
                                         @endforelse
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
