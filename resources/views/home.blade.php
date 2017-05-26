@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">
                   <div class="col-md-12">
<!--                    <h2 style="margin-top: 0">Dashboard</h2>
 -->                </div>
                </div>

                <div class="row dashboad-figures">
                <div class="col-md-3 text-center">
                <span>Entries Today</span><br/>
                <h2>{{$logs->count()}}</h2>
                </div>
                   <div class="col-md-3 text-center">
                <span>Total Drivers</span><br/>
                <h2>{{$all_drivers->count()}}</h2>
                </div>
                <div class="col-md-3 text-center">
                <span>Total Trucks</span><br/>
                <h2>{{$all_trucks->count()}}</h2>
                </div>
                <div class="col-md-3 text-center">
                <span>Total Haulers</span><br/>
                <h2>{{$all_haulers->count()}}</h2>
                </div>
                </div>

                <div class="row">                
                <div class="col-md-12">


             <!--  <bar :labels="['Today Entries','All Drivers','All Trucks']"  :values="[{{$logs->count()}}, {{$all_drivers->count()}}, {{$all_trucks->count()}}  ]">
              </bar> -->

                <section>
                <div class="tabs tabs-style-line">
                    <nav>
                        <ul>
                            <li><a href="#section-line-1"><span> Latest Logs</span></a></li>
                            <li><a href="#section-line-2"><span>In plant trucks</span></a></li>
                            <li><a href="#section-line-3"><span>In transit trucks</span></a></li>
                            <!-- <li><a href="#section-line-5"><span>Microconsoles</span></a></li>
 -->                        </ul>
                    </nav>
                    <div class="content-wrap">
                    <section id="section-line-1">
                            <div class="row text-left">
                            <div class="col-md-12">

                              @include('component.latest')


                            </div>
                            </div><!-- end row -->                            
                        </section>
                        <section id="section-line-2">
                        <div class="row text-left">
                            <div class="col-md-12">
                         
                              @include('component.inplant')
                             
                              </div><!--- end col-md-12 -->
                        </div><!-- end row -->
                        </section>
                        <section id="section-line-3">
                              <div class="row text-left">
                            <div class="col-md-12">
                         

                            @include('component.transit')
                             
                            </div><!--- end col-md-12 -->
                           </div><!-- end row -->
                        </section>
                        <!-- <section id="section-line-4">
                              <div class="row">
                                    <div class="col-md-12">
                                    <h1>Section 4</h1>
                                    </div>
                                </div> 
                        </section>
                        <section id="section-line-5">
                              <div class="row">
                                    <div class="col-md-12">
                                    <h1>Section 5</h1>
                                    </div>
                                </div> 
                        </section> -->
                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>
                    </div>
                </div><!-- end row -->
            </div>


        @foreach($today_log as $today)
                  <!-- Mark as don in transfer truck log -->
                  <div class="modal fade driverdetails{{$today->LogID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
                    <div class="modal-dialog" style="width: 900px">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Shipment Details</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row details-content">
                                  <div class="col-md-2">
                                    @foreach($today->drivers as $driver)
                                    <img class="img-responsive" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}">
                                    @endforeach
                                  </div>
                                  <div class="col-md-10">
                                      <div class="row">
                                        <div class="col-md-4">
                                           <span>Driver Name </span><br/>
                                               @foreach($today->drivers as $driver)
                                                    {{  $driver->name }}
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
                                    <span>OPERATOR</span><br/>
                                         @foreach($today->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                            @endforeach
                                    </div>
                     
                                      </div><!-- end row -->


                                     <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-4">
                                     <span>TIME IN </span><br/>
                                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                            {{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}}
                                        @empty
                                            NO IN
                                        @endforelse             
                                    </div>
                                    <div class="col-md-4">
                                    <span>TIME OUT</span><br/>
                               @foreach($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                                                    <!-- @if( contains(date('Y-m-d h:i:s A', strtotime($out->LocalTime)), 'AM' )) -->

                                                
                                                    {{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} 
                                       
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

                                    <div class="row" style="margin-top: 10px;">
                                         <div class="col-md-4">
                                    <span>Customer</span><br/>
                                      @foreach($today->customers as $customer)
                                      {{  $customer->name }}<br/>
                                      @endforeach
                                    </div>


                                    <div class="col-md-4">
                                    <span>ADDRESS</span><br/>
                                      @foreach($today->customers as $customer)
                                        {{$customer->address}}
                                      @endforeach
                                    </div>


                                      <div class="col-md-4">
                                    <span>COMMODITY</span><br/>
                                      @foreach($today->customers as $customer)
                                        {{$customer->commodity}}
                                      @endforeach
                                    </div>

                                    </div><!-- end row -->


                                  </div>
                            </div><!-- end row -->

                            <hr/>
                            <div class="row details-content" style="margin-top: 10px;">
                            <div class="col-md-6">
                             <span>TIME IN</span><br/>

                  
                                @forelse($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in)
                                       
                                             <a href="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($in->LocalTime))}}.0000{{$in->LogID}}-1.jpg" data-lightbox="{{$today->LogID}}" data-title="{{$driver->name}} - TIME IN - {{  date('Y-m-d h:i:s A', strtotime($in->LocalTime))}}">
                                                <img class="img-responsive" src="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($in->LocalTime))}}.0000{{$in->LogID}}-1.jpg">
                                                </a>

                                       
                                        @empty
                                           

                                    <div class="no-capture">

                                       <i class="pe-7s-timer"></i>
                                       <p>NO TIME IN</p>
                                       
                                       </div> 

                                        @endforelse   

                            

                            </div>
                            <div class="col-md-6">
                               <span>TIME OUT</span><br/>
                                  @forelse($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out)
                                                <a href="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($out->LocalTime.' - 24 hours'))}}.0000{{$out->LogID}}-2.jpg" data-lightbox="{{$today->LogID}}" data-title="{{$driver->name}} - TIME OUT - {{  date('Y-m-d h:i:s A', strtotime($out->LocalTime))}}">
                                                <img class="img-responsive" src="http://172.17.2.25/ASWeb/bin/GetImage.srf?From=IMG&Filename=AC.{{date('Ymd',strtotime($out->LocalTime.' - 24 hours'))}}.0000{{$out->LogID}}-2.jpg">
                                                </a>

                                        @empty

                                        <div class="no-capture">

                                       <i class="pe-7s-timer"></i>
                                       <p>NO TIME OUT YET</p>
                                       
                                       </div> 


                                        @endforelse 


                            </div>
                            </div><!-- end row -->
                        </div>
                        <div class="modal-footer">
                          @foreach($today->drivers->take(1) as $driver)
                          <a type="button" href="{{url('/drivers/'.$driver->id)}}" class="btn btn-primary pull-left">View History</a>
                          @endforeach
                          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        </div>
               

                
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->   

              @endforeach



       



@endsection
