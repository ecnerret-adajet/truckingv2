@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Out Plant - Trucks</h4>
                                <p class="category">All trucks with out plant time</p>

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
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($total_out as $today)
                                    <tr>
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
                                        
                                        @if(empty($all_in))

                                         @foreach($all_in as $in)
                                            @foreach($in->drivers->where('name', '==', $driver->name) as $driver_in)
                                                    <span class="label label-success">{{  date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @endforeach 
                                        @endforeach 

                                        @else
                                        NO IN

                                        @endif
                                        
                                        </td>    
                                        <td>

                                        @foreach($all_out as $out)
                                            @foreach($out->drivers->where('name', '==', $driver->name) as $driver_in)
                                                    <span class="label label-warning">{{  date('Y-m-d h:i:s A', strtotime($out->LocalTime))  }} </span><br/>
                                            @endforeach 
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
