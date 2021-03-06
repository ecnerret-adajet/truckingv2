@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">In Plant Trucks
                                
                                <a class="btn btn-default pull-right" href="{{url('/home')}}">
                                Back to dashboard
                                </a>
                                </h4>
                                <p class="category">All Trucks within the plant</p>
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
                                        <th>Idle Time</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($total_in as $today)
                                  @if(empty($all_out->where('CardholderID', '==', $today->CardholderID)->count()))
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

                                        {{  $today->LocalTime->diffInHours(Carbon\Carbon::now('Asia/Manila'))  }} Hour(s)

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



            </div><!-- end container-fluid -->            
@endsection
