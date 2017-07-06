<div class="row">
<div class="col-md-12">

<div class="panel panel-default" style="border: 0; padding-top:50px;">


<table class="table table-hover" id="home">
  <thead>
    <tr>
      <th>Age</th>
      <th>Plate Number</th>
      <th>Origin</th>
      <th>Destination</th>
      <th>Trip</th>
      <th></th>
      <th>IN</th>
      <th>OUT</th>
      <th>BETWEEN</th>
    </tr>
  </thead>
  <tbody id="accordion">
  @foreach($today_log as $today)
  
    <tr data-toggle="collapse" data-target="#collapse-{{$today->LogID}}" class="clickable" style="cursor: pointer">
      <td>
      <span class="btn btn-success btn-xs">
            {{ Carbon\Carbon::parse($today->LocalTime)->diffForHumans() }}      
      </span>
      </td>
      <td>

      @foreach($today->drivers as $driver)
        @foreach($driver->trucks as $truck)
            {{$truck->plate_number}}
        @endforeach
      @endforeach
      
      
      </td>
      <td>Manila</td>
      <td>
         @foreach($today->customers as $customer)
        {{  title_case($customer->address) }}<br/>
        @endforeach
      </td>
      
      <td>
   
      @foreach($today->customers as $customer)
      <?php
            $destination = str_replace(' ','+',$customer->address);
            //make request
            $url = "https://maps.googleapis.com/maps/api/directions/json?origin=L2-3+B1+BV+Romero+Blvd,+Tondo,+Manila,+Tondo,+Manila,+Metro+Manila&destination={$destination}&key=AIzaSyDc28EA8qpYrsF10DKWKa4CSVKYSNZrudQ";
            $result = file_get_contents($url);
            $data = json_decode($result,true);
      ?>
      @if($data['status'] != "NOT_FOUND" && $data['status'] != "ZERO_RESULTS" )
      {{ $data['routes'][0]['legs'][0]['distance']['text'] }} <br/>
      @else
      CANNOT DETERMINE
      @endif
      @endforeach

      </td>

      <td>

      @if(count($today->customers))
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
        @php $final_in = ''; @endphp
        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
            {{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}}
        @empty
            NO IN 
        @endforelse    
      </td>
      <td>
       @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
            {{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} 
        @empty
            NO OUT
        @endforelse 
      </td>
      <td>
      @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out )
        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in )
        {{  $in->LocalTime->diffInHours($out->LocalTime)}} Hour(s)
    @empty
        NO PAIRED TIME IN
    @endforelse
    @empty
        NO PAIRED TIME OUT
    @endforelse
      </td>
    </tr>



    <!--- accordion details -->
     <tr id="collapse-{{$today->LogID}}" class="panel-collapse collapse">
        <td colspan="9">
        
                         <div class="row table-results">

                                <!-- image -->
                                <div class="col-md-2">
                                @foreach($today->drivers as $driver)
                                    <img class="img-responsive" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}">
                                    @endforeach
                                </div>

                                <div class="col-md-6" style="border-right: 2px solid #f5f7f7">



                                   <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-4">
                                                 <span>Operator </span>
                                                @foreach($today->drivers as $driver)
                                                    @foreach($driver->haulers as $hauler)
                                                    <h5 style="font-weight: 700; margin-top: 0;">{{ $hauler->name }}</h5>
                                                    @endforeach
                                                @endforeach
                                            </div>

                                            <div class="col-md-4">
                                                 <span>Trip Distance </span>
                                                    <h5 style="font-weight: 700; margin-top: 0;">

                                                    @if(count($today->customers))
                                                       @if($data['status'] != "NOT_FOUND" && $data['status'] != "ZERO_RESULTS")
                                                        {{ $data['routes'][0]['legs'][0]['distance']['text'] }} 
                                                        @else
                                                         CANNOT DETERMINE
                                                        @endif
                                                    @endif

                                                    </h5>
                                            </div>

                                            <div class="col-md-4">
                                                 <span>Exptected Duration  </span>

                                                    <h5 style="font-weight: 700; margin-top: 0;"> 

                                                    @if(count($today->customers))
                                                      @if($data['status'] != "NOT_FOUND" && $data['status'] != "ZERO_RESULTS")
                                                        {{ $data['routes'][0]['legs'][0]['duration']['text'] }}
                                                        @else
                                                         CANNOT DETERMINE
                                                        @endif
                                                    @endif 
                                                    
                                                    </h5>
                                            </div>
                                            
                                        
                                    </div>


                                    <div class="row">

                                            <div class="col-md-4">
                                            <span>Driver Name </span><br/>
                                                    @foreach($today->drivers as $driver)
                                                     <a href="{{ url('drivers/'.$driver->id.'/edit') }}">   {{  $driver->name }} </a>
                                                    @endforeach                          
                                            </div>

                                             <div class="col-md-4">
                                            <span>Plate Number</span><br/>
                                                @foreach($today->drivers as $driver)
                                                            @foreach($driver->trucks as $truck)
                                                                {{$truck->plate_number}}
                                                            @endforeach
                                                    @endforeach
                                            </div>


                                            <div class="col-md-4">
                                            <span>Contact Number</span><br/>
                                                @foreach($today->drivers as $driver)
                                                    <a href="tel:0{{$driver->phone_number}}">0{{$driver->phone_number}}</a>
                                                @endforeach
                                            </div>
                                    </div>


                                    <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-4">
                                     <span>TIME IN </span><br/>
                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                            {{ $final_in = date('F d, Y h:i:s A', strtotime($in->LocalTime))}}
                                        @empty
                                            NO IN <br/>
                                        @endforelse             
                                    </div>
                                    <div class="col-md-4">
                                    <span>TIME OUT</span><br/>
                                    @foreach($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                                                    <!-- @if( contains(date('Y-m-d h:i:s A', strtotime($out->LocalTime)), 'AM' )) -->

                                                
                                                    {{ $final_out = date('F d, Y h:i:s A', strtotime($out->LocalTime))}} 
                                       
                                                    <!-- @endif -->


                                             @endforeach 
                                    </div>
                                  <div class="col-md-4">
                                    <span>TIME BETWEEN</span><br/>
                                     @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out )
                                    @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in )
                                                {{  $in->LocalTime->diffInHours($out->LocalTime)}} Hour(s)
                                            @empty
                                                NO PAIRED TIME IN
                                            @endforelse
                                         @empty
                                              NO PAIRED TIME OUT
                                         @endforelse


                                    </div>


                                    </div><!-- end row -->

                                </div> <!-- end col-md-7 -->


                                <!-- google static map
                                <div class="col-md-8" id="map">
                                @if(count($today->customers))
                                @foreach($today->customers as $customer)
                                      <?php
                                            $destination = str_replace(' ','+',$customer->address);
                                            $source = "https://maps.googleapis.com/maps/api/staticmap?autoscale=2&size=623x200&maptype=roadmap&format=png&visual_refresh=true&markers=size:large%7Ccolor:red%7Clabel:1%7Cmanila&markers=size:large%7Ccolor:blue%7Clabel:2%7C{$destination}&key=AIzaSyDc28EA8qpYrsF10DKWKa4CSVKYSNZrudQ";
                                        ?>      
                                         <img class="img-responsive" src="{{$source}}">
                                @endforeach
                                @endif
                                </div>
                                -->
                                
                                

                                <div class="col-md-4">

                                    @forelse($today->customers as $customer)
                                    <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-12">
                                                
                                                     <span>Customer </span>
                                                    <h5 style="font-weight: 700; margin-top: 0;">{{  title_case($customer->name)}}</h5>
                                                     <span>Customer address </span>
                                                    <p>{{$customer->address}}</p>
                                               
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                Show Phone
                                            </a>

                                            @if($data['status'] != "NOT_FOUND" && $data['status'] != "ZERO_RESULTS")
                                                <?php 
                                                $customer_address = addslashes($data['routes'][0]['legs'][0]['end_address']);
                                                ?>                                 
                                                <a class="btn btn-primary btn-fill btn-sm" id="show-map" onclick="showMapModal('{{ $customer_address }}')">
                                                    View Map
                                                </a>
                                            @endif
                                            
                                        </div>
                                          
                                    </div>
                                    @empty
                                    <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-12 text-center">

                                            <em>
                                            <h5 style="color: #ccc;">NO CUSTOMER CAPTURED</h5>
                                            </em>

                                            </div>
                                    </div>
                                     @endforelse

                                </div><!-- end col-md-4 -->



                        </div><!-- end row table-->
        </td>
    </tr>

   @endforeach
  </tbody>
</table>   


            </div>
            
            </div>
        </div>


@section('script')
    <script>

            $(document).ready(function() {

                $('.clickable').on('click', function(e) {
                e.preventDefault();

                var elem = $(this);
                var value = elem.data('value');

                // remove a.active
                elem.parent().find('.success').removeClass('success');
                
                // add .active to the selected link
                elem.addClass('success');
                // change tile value
                 });

               
                $("#show-map").click(function(e) {
                     e.preventDefault();
                    $("#map").toggle();
                });
             });


            var currURL = "";
            function showMapModal(customer_address){
                var url = "http://www.google.com/maps/embed/v1/directions?origin=L2-3+B1+BV+Romero+Blvd,+Tondo,+Manila,+Tondo,+Manila,+Metro+Manila&destination="+ customer_address +"&key=AIzaSyDmCmQ3m-UNz1j1reAgrTcGNu1zLcm7FJc";
                if(currURL != url) //avoid reloading same map
                {
                    $('#frame_map').attr('src', url)
                }
                $('#myModal').modal('show'); 
                currURL = url;
            }

    </script>
@endsection
@extends('component.map_modal')