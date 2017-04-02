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
                                             " class="pe-7s-box2"></i>
                                        <div class="">
                                        <p>{{$haulers->count()}} Total Hauler</p>
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
                                        <p> Top Hauler</p>
                                        <table class="table">
                   
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


                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Haulers Master List</h4>
                                <p class="category">Total Hauler registered in the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                            

                            <hr/>

                              <table class="table table-striped">
                                    <thead>
                                        <th></th>
                                        <th>Hauler Name</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($haulers as $hauler)


                                        <tr>
                                            <td>
                                            <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 50px;">
                                            </td>
                                            <td>
                                              {{$hauler->name}}                                    
                                            </td>
    
                                            <td>
                                            {{$hauler->address}}                                          
                                            </td>
                                            <td>
                                            {{$hauler->contact_number}}
                                            </td>
                                            <td>
                                                        <div class="dropdown">
                                                          <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                                            Option
                                                            <span class="caret"></span>                                                        
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/haulers/'.$hauler->id) }}">View Details</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/haulers/'.$hauler->id.'/edit')}}">Edit Hauler</a></li>                                                        
                                                            <li role="presentation" class="divider"></li>                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete Hauler</a></li>
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
