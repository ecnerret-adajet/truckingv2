@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p>Truck Details</p>
                    </div>
                    <div class="panel-body">
                        <div class="row"> 
                            <div class="col-md-4 text-center">
                                 <i style="font-size: 70px;
                                    color: #a9a9a9;
                                        " class="pe-7s-helm"></i>
                                <p>{{$trucks->count()}} Total Trucks</p>

                                <a class="btn btn-primary btn-sm" href="{{url('/home')}}">
                                Back to dashboard
                                </a>

                            </div>
                            <div class="col-md-4 text-center">
                            <i style="font-size: 70px;
                                    color: #a9a9a9;
                                        " class="pe-7s-check"></i>
                                <p>{{  $trucks->where('availability','=', 1)->count() }} Active Trucks</p>

                                <button class="btn btn-success btn-sm">
                                ACTIVE
                                </button>
                            </div>
                            <div class="col-md-4 text-center">
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

                    </div>
                </div>


            </div>            



        <div class="row">                
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="title">Trucks Master List
                        @role(('Administrator'))
                        <a class="btn btn-primary btn-sm pull-right" href="{{url('/trucks/create')}}">
                        Add New Truck
                        </a>
                        @endrole
                        <a href="{{url('/exportTrucks')}}" style="margin-right: 10px;" class="btn btn-success btn-sm pull-right">
                        Export to Excel
                        </a>
                        </h4>
                        <p class="category">Total Hauler registered in the system</p>
                    </div>
                    <div class="content table-responsive table-full-width" id="feed">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Plate Number</th>
                                    <th>Vehicle Type</th>
                                    <th>Capacity</th>
                                    <th>Hauler</th>
                                    <th>Current Driver</th>
                                    <th class="text-center">Status</th>
                                    <th width="2%"></th>
                                </tr>
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
                                    <td>
                                        @foreach($truck->drivers as $driver)
                                            @foreach($driver->haulers as $hauler)
                                                {{ $hauler->name }} <br/>
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($truck->drivers as $driver)
                                            {{ $driver->name }} </br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if($truck->availability == 1)
                                            <span class="inTransit">
                                            <i class="ion ion-record"></i>
                                            </span>
                                        @else
                                            <span class="inPlant">
                                            <i class="ion ion-record"></i>
                                            </span>                                           
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown pull-right">
                                        <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                        <i class="fa fa-ellipsis-v"></i>                                                       
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">    
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/trucks/'.$truck->id)}}"><i class="fa fa-file-o" aria-hidden="true"></i> <span class="hidden-xs">View Details</span></a></li>
                                        @role(('Administrator'))
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/trucks/'.$truck->id.'/edit')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Edit Truck</span></a></li>                                                        
                                        <li role="presentation" class="divider"></li>                                                        
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
                                        <li role="presentation" class="divider"></li> 
                                        <li role="presentation"><a data-toggle="modal" data-target=".bs-delete{{$truck->id}}-modal-lg" href=""><i class="fa fa-ban" aria-hidden="true"></i> <span class="hidden-xs">Remove Truck</span></a></li>
                                        @endrole
                                        </ul>                                                        
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- end col-md-12-->
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

                                                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ url('/trucks/inactive/'.$truck->id) }}">
                            {!! csrf_field() !!}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button> 
                        </form>                    
                    </div>
                                
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ url('/trucks/active/'.$truck->id) }}">
                            {!! csrf_field() !!}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            {!! Form::submit('Confirm', ['class' => 'btn  btn-primary'])  !!}                    
                        </form> 
                    </div>
                
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->   
    @endforeach    


@endsection
