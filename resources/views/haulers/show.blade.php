@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                <div class="row">                
                <!-- table  -->
                 
                          <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-box2"></i>
                                        <div class="">
                                        <p>{{ $hauler->name }}</p>
                                        </div>

               
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
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-helm"></i>
                                        <div class="">
                                        <p>{{ $hauler->drivers->count() }} total number of Truck</p>
                                        </div>

               
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



      


                </div><!-- end row -->

                  <div class="row">                
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Hauler's logs

                                </h4>
                                <p class="category">Total number of opertor trips</p>
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
        
                            <hr/>

                            {{$logs->count()}}






                            </div>
                        </div>
                    </div>


                </div><!-- end row -->



            </div><!-- end container fluid -->
@endsection
