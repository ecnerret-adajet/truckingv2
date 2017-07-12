@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <div class="col-lg-12 col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                  <p> Top no. of trucks per operator</p>
                            </div>
                            <div class="panel-body">

                                <div class="row"> 
                                    <div class="col-md-6 text-center">
                                           <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-box2"></i>
                                        <div class="">
                                        <p>{{$haulers->count()}} Total Hauler</p>
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{url('/home')}}">
                                        Back to dashboard
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                        <thead>
                                        <tr>
                                        <th>Hauler Name</th>
                                        <th>Number of trucks</th>
                                        </tr>
                                        </thead>
                                        @foreach($top_hauler as $top)
                                        <tr>
                                        <td>{{$top->name}}</td>
                                        <td>
                                            {{ $top->drivers->count() }}
                                        </td>
                                        </tr>
                                        @endforeach

                                        </table>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                <!-- table  -->
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Haulers Master List
                                @role(('Administrator'))
                                    <a class="btn btn-sm btn-primary pull-right" href="{{url('/haulers/create')}}">Add Hauler</a>
                                @endrole
                                </h4>
                                <p class="category">Total Hauler registered in the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                                                 
                              <table class="table table-striped">
                                    <thead>
                                        <th>Hauler Name</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th class="text-center">Number of Trucks</th>
                                        <th width="2%"></th>
                                    </thead>
                                    <tbody>
                                    @foreach($haulers as $hauler)


                                        <tr>
                                            <td>
                                              {{$hauler->name}}                                    
                                            </td>
    
                                            <td>
                                            {{$hauler->address}}                                          
                                            </td>

                                            <td>
                                            {{$hauler->contact_number}}
                                            </td>
                                            <td class="text-center">
                                            {{ $hauler->drivers->count() }}
                                            </td>
                                            <td>

                                                <div class="dropdown pull-right">
                                                <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                                <i class="fa fa-ellipsis-v"></i>                                                       
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">    
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/haulers/'.$hauler->id)}}"><i class="fa fa-file-o" aria-hidden="true"></i> <span class="hidden-xs">View Details</span></a></li>
                                                @role(('Administrator'))
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/haulers/'.$hauler->id.'/edit')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Edit Hauler</span></a></li>                                                        
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
                    </div>


                </div><!-- end row -->
            </div>
@endsection
