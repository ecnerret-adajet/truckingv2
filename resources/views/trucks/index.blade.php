@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">                
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Trucks Master List</h4>
                                <p class="category">Total Hauler registered in the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                            

                            <hr/>

                              <table class="table table-striped">
                                    <thead>
                                        <th></th>
                                        <th>Plate Number</th>
                                        <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($trucks as $truck)


                                        <tr>
                                            <td>
                                            <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 50px;">
                                            </td>
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
                                                        <div class="dropdown">
                                                          <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                                            Option
                                                            <span class="caret"></span>                                                        
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">View Details</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/haulers/'.$truck->id.'/edit')}}">Edit Truck</a></li>                                                        
                                                            <li role="presentation" class="divider"></li>                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete Truck</a></li>
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
