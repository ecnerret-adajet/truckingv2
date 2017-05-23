@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">In Transit Trucks
                                
                                <a class="btn btn-default pull-right" href="{{url('/home')}}">
                                    Back to dashboard
                                </a>
                                </h4>
                                <p class="category">All trucks with paired in & out time</p>

                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                            <hr/>

                            
                            

 <table class="table">
                                <thead>
                                    <tr>
                                        <th>Driver Name</th>
                                        <th>Plate Number</th>
                                        <th>Operator</th>
                                        <th>Plant in</th>
                                        <th>Plant out</th>
                                        <th>Idle Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($total_out as $today)
                                      @if($all_out->where('CardholderID', '==', $today->CardholderID)->count() > 0)
                                   
                                    <tr class="">
                                        <td>
                                            @foreach($today->drivers as $driver)
                                                    <a href="{{url('/drivers/'.$driver->id)}}"> 
                                                    {{  $driver->name }}
                                                    </a>
                                            @endforeach 
                                        </td>
                                        <td>
                                          @foreach($today->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                        </td>  
                                        <td>
                                        @foreach($today->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                            @endforeach 
                                        </td>  
                                        <td>

                                        <span class="label label-success">{{  date('Y-m-d h:i:s A', strtotime($today->LocalTime))}} </span><br/>
                                        
                                        </td> 

                                        <td>
                                        @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                                                    <span class="label label-warning">{{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                        @empty
                                        NO OUT
                                        @endforelse  
                                        </td>

                                        <td>

                                        {{  $today->LocalTime->diffInHours($out->LocalTime)  }} Hour(s)

                                        </td>                               
                                    </tr>    
                                       @endif                          
                                    @endforeach                            
                                </tbody>
                            </table>






                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>            
@endsection
