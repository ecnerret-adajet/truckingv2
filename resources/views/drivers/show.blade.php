@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">                
                <!-- table  -->
                    <div class="col-md-8" >
                        <div class="card">
                            <div class="header">
                              <h4 class="title">Driver Trip logs</h4>

            <!--                     <div class="row">
                                <div class="col-md-3">
                                     <img class="img-responsive img-circle" 
                                        src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))  }}" 
                                        style="width: auto; height: 200px;">
                                </div>

                                <div class="col-md-7">
                                <div class="row">
                                <div class="col-md-6 driver-info">
                                    {{$driver->name}}
                                </div>
                                <div class="col-md-6 driver-info">
                                TOTAL TRIPS:  {{$unique_log->count()}}
                                </div>
                                </div>
                                <div class="row driver-row">
                                    <div class="col-md-6 driver-info">
                                    @foreach($driver->trucks as $truck)
                                       <span class="label label-success"> {{$truck->plate_number}} </span>
                                    @endforeach
                                    </div>
                                    <div class="col-md-6 driver-info">
                                    STATUS:
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12 driver-info">
                                     @foreach($driver->haulers as $hauler)
                                        {{$hauler->name}}
                                    @endforeach                                
                                    </div>
                                </div>
                                </div>
                                </div> -->

                            </div>

                            <div class="content table-responsive table-full-width" id="feed">

                             <table class="table table-striped">
                                     <thead>
                                        <th>Plate Number</th>
                                        <th>Direction</th>
                                        <th>Time</th>
                                    </thead>
                                    <tbody>


                                    @foreach($logs  as $log)
                                        <tr>
                                            <td>
                                            @foreach($log->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach  
                                            </td>
                                            <td>
                                           {{ $log->Direction == 1 ? 'IN' : 'OUT' }}
                                            </td>
                                            <td>
                                         {{  date('Y-m-d h:i:s A', strtotime($log->LocalTime))}}
                                            </td>
                                        </tr>
                                    @endforeach



                                    </tbody>
                             </table>










                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                       <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                     <img class="avatar border-gray" 
                                        src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))  }}" 
                                        style="width: auto; height: 200px;">

                                      <h4 class="title">
                                        {{$driver->name}}
                                      <br/>
                                  
                                      </h4>
                                    </a>

                                      <p>
                                        @foreach($driver->haulers as $hauler)
                                        {{$hauler->name}}
                                        @endforeach
                                      </p>
                                </div>

                                <p class="description text-center"> Total Number of Trips: {{$unique_log->count()}}  <br>
                                    PLATE NUMBER: @foreach($driver->trucks as $truck)
                                       <span class="label label-success"> {{$truck->plate_number}} </span>
                                    @endforeach
                                </p>
                            </div>
                            <hr>
                            <div class="text-center" style="padding: 15px;">
                               
                               <a class="btn btn-warning btn-sm btn-block" href="{{ url('/drivers/'.$driver->id.'/edit') }}">
                               Edit Driver

                               </a>

                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>
@endsection
