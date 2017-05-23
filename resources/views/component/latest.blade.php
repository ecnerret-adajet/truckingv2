                              <div class="list-group tab-content">
                              @foreach($today_log as $today)

                              <a data-toggle="modal" data-target=".driverdetails{{$today->LogID}}" class="list-group-item" href="" >


                                <div class="row">
                                <div class="col-md-1">


                                @foreach($today->drivers as $driver)
                                    <img class="img-responsive" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}">
                                    @endforeach


                                </div>

                                <div class="col-md-10">
                                    <div class="row">
                                    <div class="col-md-3">
                                     <span>Driver Name </span><br/>
                                               @foreach($today->drivers as $driver)
                                                    {{  $driver->name }}
                                            @endforeach                          
                                    </div>
                                    <div class="col-md-3">
                                    <span>Plate Number</span><br/>
                                         @foreach($today->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                    </div>
                                    <div class="col-md-3">
                                    <span>OPERATOR</span><br/>
                                         @foreach($today->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                            @endforeach
                                    </div>
                                    <div class="col-md-3">
                                    <span>Customer</span><br/>
                                      @foreach($today->customers as $customer)
                                      {{  $customer->name }}<br/>
                                      @endforeach
                                    </div>

                           
                                    </div><!-- end row -->


                                    <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                     <span>TIME IN </span><br/>
                                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                            {{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}}
                                        @empty
                                            NO IN
                                        @endforelse             
                                    </div>
                                    <div class="col-md-3">
                                    <span>TIME OUT</span><br/>
                               @foreach($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                                                    <!-- @if( contains(date('Y-m-d h:i:s A', strtotime($out->LocalTime)), 'AM' )) -->

                                                
                                                    {{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} 
                                       
                                                    <!-- @endif -->


                                             @endforeach 
                                    </div>
                                  <div class="col-md-3">
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

                                        <div class="col-md-3">
                                    <span>Commodity</span><br/>
                                      @foreach($today->customers as $customer)
                                        {{$customer->commodity}}
                                      @endforeach
                                    </div>
                                    </div><!-- end row -->

                                </div>
                                </div>
                              </a>
                              @endforeach
                            </div>