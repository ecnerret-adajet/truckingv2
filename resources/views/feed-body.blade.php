      @extends('feed-layout')    

      @section('feed-live')

         <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h4 class="title">Activity Feed
                                <span class="pull-right">
                                {{$today_result->count()}}
                                </span> 
                                
                                </h4>
                                <p class="category">Latest trucks activity</p>
                            </div>
                        

                              <table class="table" id="LiveFeed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Driver Name</th>
                                        <th>Plate Number</th>
                                        <th>Operator</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>Time between</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $i = 1; 
                                ?>
                                @foreach($today_result as $result)
                                    <tr>
                                        <td> 
                                    
                                    @foreach($result->drivers as $driver)
                                    <img class="img-responsive img-circle" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}" style="display:block; margin: 10px auto; width: 50px; height: auto;">
                                    @endforeach
                                        
                                        
                                        </td>
                                        <td>

                                        <br/>
                                            @foreach($result->drivers as $driver)
                                                    <a href="{{url('/drivers/'.$driver->id)}}"> 
                                                    {{  $driver->name }}
                                                    </a>
                                            @endforeach  
                                        </td>   
                                        <td>
                                        @foreach($result->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                        </td>   
                                        <td>
                                        @foreach($result->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                        @endforeach                                         
                                        
                                        </td>   


                                        
                                        <td>


                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $result->CardholderID)->take(1) as $in)
                                            <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                        @empty
                                             @forelse($all_in_2->where('CardholderID', '==', $result->CardholderID)->take(1) as $in)
                                                <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @empty
                                                NO IN
                                            @endforelse  
                                        @endforelse     


                                          
                                        </td>   
                                             
                                        <td>
                                        <?php $final_out = ''; ?>                                     
                                        @forelse($all_out->where('CardholderID', '==', $result->CardholderID)->take(1) as $out)
                                                    <span class="label label-warning">{{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                        @empty
                                        NO OUT
                                        @endforelse   
                                        </td> 
                                       
                                        <td>

                                         @forelse($all_out->where('CardholderID', '==', $result->CardholderID)->take(1) as $out )
                                            @forelse($all_in->where('CardholderID', '==', $result->CardholderID)->take(1) as $in )
                                                {{  $in->LocalTime->diffInHours($out->LocalTime)}} Hour(s)
                                            @empty
                                                NO PAIRED TIME IN
                                            @endforelse
                                         @empty
                                              NO PAIRED TIME OUT
                                         @endforelse





                                           
                                     
                                           
                                        </td>      
                                    </tr>                        
                                @endforeach  


                                </tbody>
                            </table>

        </div>

    @endsection