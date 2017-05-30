 <!-- Mark as don in transfer truck log -->
                  <div class="modal fade getSummary{{$today->LogID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
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


                                    <!--insert time logs here -->
                                

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

                {!! Form::model($monitor = new \App\Monitor, ['url' => '/monitors/'.$today->LogID, 'files' => 'true', 'enctype' => 'multipart\form-data']) !!}
                {!! csrf_field() !!}



                @include('monitors.form')


                            <!-- insert log snapshot here -->
                        
                        </div>
                   
                         <button type="submit" class="btn btn-primary pull-right">Submit</button>
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                         
                       

                {!! Form::close() !!}
               

                
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->   