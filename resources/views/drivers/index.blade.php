@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">

                          <div class="col-lg-7 col-sm-7">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12 text-center">
<!--                                     <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-id"></i> -->
                                        <p>{{$drivers->count()}} Total Drivers</p>

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


                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <!-- <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-id"></i> -->
                                        <p>Driver change truck logs </p>

                                        <table class="table">
                                                <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>FROM</th>
                                                            <th>TO</th>
                                                            <th>RETURN</th>
                                                            <th>#</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($transfers->where('availability',1) as $transfer)
                                                    <tr>
                                                        <td>{{$transfer->driver->name}}</td>
                                                        <td>
                                                        {{$transfer->from_truck}}
                                                        </td>
                                                        <td class="danger">
                                                        {{$transfer->to_truck}}
                                                        </td>
                                                        <td>
                                                        {{ date('m-d-Y', strtotime($transfer->return_date)) }}
                                                        </td>
                                                        <td>
                                                        <a data-toggle="modal" data-target=".bs-mark{{$transfer->id}}" class="btn btn-primary btn-xs" href="">
                                                        MARK DONE
                                                        </a>
                                                        </td>
                                                    </tr> 
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        <span style="color: #c5c5c5; text-transform: uppercase; font-size: 14px;"><em>No transfer logs</em></span>
                                                    </td>
                                                </tr>


                                                @endforelse
                                                </tbody>
                                        </table>               
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                   <small class="stats" style="text-transform: uppercase; font-size: 10px;">
                                        <a>
                                            VIEW ALL
                                        </a>
                                  </small>
                                </div>
                            </div>
                        </div>


                    </div><!-- first panel -->



                           <div class="col-lg-5 col-sm-5">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <p> Top Drivers per trip: 2017</p>

                                        <table class="table">
                                            <thead>
                                            <tr>
                                            <th>Driver Name</th>
                                            <th>Number of trips</th>
                                            </tr>
                                            </thead>
                                            @foreach($top_driver as $log)
                                                <tr>
                                                 <td>                    
                                                 @foreach($log->drivers as $driver)
                                                    {{$driver->name}}
                                                 @endforeach
                                                 </td>
                                                 <td>
                                                {{ $logs->where('CardholderID', $log->CardholderID)->count() }}
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
                                <h4 class="title">All Drivers

                                <a href="{{ url('/drivers/create') }}"  class="btn btn-primary btn-sm pull-right">
                                Add New Driver
                                </a>
                                </h4>
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
                                        <th>Driver #</th>
                                        
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


                                           
                                           <img class="img-responsive img-circle" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}" style="width: auto; height: 40px;">
                                           
                                           
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
                                            <td>
                                            {{$driver->cardholder->Name}}                                            
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>




                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div><!-- end containe-fluid-->

            @foreach($transfers as $transfer)
        <!-- Mark as don in transfer truck log -->
        <div class="modal fade bs-mark{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transfer Return</h4>
              </div>
              <div class="modal-body">
                      <div class="row">
                <div class="col-md-12">
                <div class="panel-body text-center"> 
                <p>  
                    Please confirm to apply changes
                </p>                        
             <form method="POST" action="{{ url('/transfers/remove/'.$transfer->id) }}">
              {!! csrf_field() !!}
                                                
            </div>
                </div>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
                  
                   
              </div>
              </form> 
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->   

            @endforeach


@endsection
