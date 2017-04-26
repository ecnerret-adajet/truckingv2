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
                                             " class="pe-7s-helm"></i>
                                        <p>{{$trucks->count()}} Total Trucks</p>

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
                                     <div class="col-md-6 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-check"></i>
                                        <p>{{  $trucks->where('availability','=', 1)->count() }} Active Trucks</p>

                                        <button class="btn btn-success btn-sm">
                                        ACTIVE
                                        </button>
               
                                    </div>
                                     <div class="col-md-6 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-close-circle"></i>
                                       <p>
                                        {{$trucks->where('availability','=',0)->count()}} Inactive Trucks
                                       </p>
                                              
                                         <button class="btn btn-warning btn-sm">
                                        INACTIVE
                                        </button>

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
                                <h4 class="title">Trucks Master List
                                <a class="btn btn-primary btn-sm pull-right" href="{{url('/trucks/create')}}">
                                Add New Truck
                                </a>
                                </h4>
                                <p class="category">Total Hauler registered in the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                            

                            <hr/>



                              <table class="table table-striped">
                                    <thead>
                                        <th>Plate Number</th>
                                        <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Status</th>
                                    </thead>
                                    <tbody>

                                    @foreach($trucks as $truck)


                                        <tr>
                                            <td>
                                              {{$truck->plate_number}}                                    
                                            </td>
    
                                            <td>
                                            {{$truck->vehicle_type}}                                          
                                            </td>
                                            <td>
                                            {{$truck->capacity}}
                                            </td>
                                            <td class="text-center">
                                                        <div class="dropdown">
                                                          <button class="btn dropdown-toggle btn-sm btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                                            Option
                                                            <span class="caret"></span>                                                        
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">View Details</a></li>
                                                            <li role="presentation">
                                                            @if($truck->availability == 1)
                                                           <a data-toggle="modal" data-target=".bs-setInactive{{$truck->id}}-modal-lg" href="">
                                                            Set as inactive
                                                             </a>
                                                            @else
                                                            <a data-toggle="modal" data-target=".bs-setActive{{$truck->id}}-modal-lg" href="">
                                                            Set as active
                                                            </a>
                                                            @endif
                                                           </li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/haulers/'.$truck->id.'/edit')}}">Edit Truck</a></li>                                                        
                                                            <li role="presentation" class="divider"></li>                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete Truck</a></li>
                                                          </ul>                                                        
                                                        </div>
                                            </td>
                                            <td>
                                            @if($truck->availability == 1)
                                                <button class="btn btn-success btn-sm btn-block">
                                                ACTIVE
                                                </button>
                                            @else
                                                <button class="btn btn-warning btn-sm btn-block">
                                                INACTIVE
                                                </button>                                            
                                            @endif
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

        @foreach($trucks as $truck)
         <!-- Change availabitlity status to inactive -->
        <div class="modal fade bs-setInactive{{$truck->id}}-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change to inactive</h4>
              </div>
              <div class="modal-body">
                      <div class="row">
                <div class="col-md-12">
                <div class="panel-body text-center"> 
                <p>  
                    Are you sure you want to change the truck <em>Availability</em>?
                </p>                        
             <form method="POST" action="{{ url('/trucks/inactive/'.$truck->id) }}">
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



         <!-- Change availabitlity status to active -->
        <div class="modal fade bs-setActive{{$truck->id}}-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change to active</h4>
              </div>
              <div class="modal-body">
                      <div class="row">
                <div class="col-md-12">
                <div class="panel-body text-center"> 
                <p>  
                    Are you sure you want to change the truck <em>Availability</em> to active?
                </p>                        
             <form method="POST" action="{{ url('/trucks/active/'.$truck->id) }}">
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
