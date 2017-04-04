@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                          <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-6 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-users"></i>
                                        <div class="">
                                        <p>{{$users->count()}} Total Users</p>
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{url('/users/create')}}">
                                        Add New User
                                        </a>
               
                                    </div>

                                <div class="col-md-6 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-lock"></i>
                                        <div class="">
                                        <p>{{$users->count()}} Total Roles</p>
                                        </div>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target=".create-role" href="">
                                        Add New Role
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
                                        <p> All Roles</p>

                                        <table class="table">
                                        <thead>
                                        <tr>
                                           <th>#</th>
                                            <th>Role Name</th>
                                            <th>Action</th>
                                        </tr>
                                           
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $role)
                                          <tr>
                                              <td>{{$role->id}}</td>
                                              <td>{{$role->name}}</td>
                                              <td>
                                              <a class="btn btn-default btn-xs" data-toggle="modal" data-target=".edit-role-{{$role->id}}">
                                              Edit Role
                                              </a>
                                              </td>
                                          </tr>
                                        @endforeach
                                        </tbody>

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
                                <h4 class="title">All Users</h4>
                                <p class="category">Total users in the system</p>


                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                            

                            <hr/>

                              <table class="table table-striped">
                                    <thead>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)


                                        <tr>
                                            <td>
                                            <img class="img-responsive" src="{{ asset('img/profile/avatar.png') }}" style="width: auto; height: 50px;">
                                            </td>
                                            <td>
                                              {{$user->name}}                                    
                                            </td>
    
                                            <td>
                                            {{$user->email}}                                          
                                            </td>
                                            <td>
                                            @foreach($user->roles as $role)
                                            <span class="label label-success"> {{$role->name}}</span>
                                            @endforeach
                                            </td>
                                            <td>
                                                        <div class="dropdown">
                                                          <button class="btn dropdown-toggle btn-sm btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                                                            Option
                                                            <span class="caret"></span>                                                        
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/users/'.$user->id) }}">View Details</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/users/'.$user->id.'/edit')}}">Edit User</a></li>                                                        
                                                            <li role="presentation" class="divider"></li>                                                        
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete User</a></li>
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



            <!-- Create Role Modal -->
            <div class="modal fade create-role" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog">
                <div class="modal-content" style="min-width: 850px;  margin-left: -80px;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Role</h4>
                  </div>
                  <div class="modal-body">
                  {!! Form::open(array('route' => 'roles.store','method'=>'POST','class' => 'form-horizontal')) !!}
                    {!! csrf_field() !!}

                  
                  @include('roles.form')

                  
                  </div><!-- modal body -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                   {!! Form::close() !!}
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            @foreach($roles as $role)
            <!-- Edit Role Modal -->
            <div class="modal fade edit-role-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog">
                <div class="modal-content" style="min-width: 850px;  margin-left: -80px;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Role</h4>
                  </div>
                  <div class="modal-body">
                  {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id], 'class' => 'form-horizontal' ]) !!}
                  {!! csrf_field() !!}

                  
                  @include('roles.form')

                  
                  </div><!-- modal body -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                   {!! Form::close() !!}
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            @endforeach    

            
@endsection
