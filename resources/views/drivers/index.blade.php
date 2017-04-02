@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">

                          <div class="col-lg-6 col-sm-6">
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
                                        <a class="btn btn-primary btn-sm" href="{{url('/home')}}">
                                        Back to dashboard
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




                           <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <p> Top Driver Trips</p>
                                        <table class="table">
                                            @foreach($top_log as $log)
                                                <tr>
                                                <td>
                                                 @foreach($log->drivers as $driver)
                                                        {{  $driver->name }}
                                                 @endforeach                            
                                                </td>
                                                 <td>


                                
                                                                                             
                                                 </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                <a href="#">
                                   <small  style="text-transform: uppercase; font-size: 10px;">
                                         View all
                                  </small>
                                  </a>
                                </div>
                            </div>
                        </div>


                    </div>



        


             





                <div class="row">                
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Drivers</h4>
                                <p class="category">Total driver registered in the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                            

                            <hr/>

                              <table class="table table-striped">
                                    <thead>
                                         <th class="text-center">Action</th>
                                        <th></th>
                                        <th>Driver Name</th>
                                        <th>Phone Number</th>
                                        <th>Substitute</th>
                                        <th>Operator</th>
                                        
                                    </thead>
                                    <tbody>
                                    @foreach($drivers as $driver)


                                        <tr>
                                            <td>
                                                        <div class="dropdown">
                                                          <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                                            Option
                                                            <span class="caret"></span>                                                        
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/drivers/'.$driver->id)}}">View Details</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/drivers/'.$driver->id.'/edit')}}">Edit Driver</a></li>                                                        
                                                            <li role="presentation" class="divider"></li>                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete Driver</a></li>
                                                          </ul>                                                        
                                                        </div>
                                            </td>                                            <td>
                                            <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 40px;">
                                            </td>
                                            <td>
                                              {{$driver->name}}                                    
                                            </td>
    
                                            <td>
                                            {{$driver->phone_number}}                                          
                                            </td>
                                            <td>
                                            {{$driver->substitute}}
                                            </td>
                                            <td>
                                                @foreach($driver->haulers as $hauler)
                                                    {{$hauler->name}}
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
