@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">


        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user bg-yellow-active">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow-active">

              <h3 class="widget-user-desc">
              Drivers
                <div class="dropdown pull-right">
                        <a href="#" class="btn btn-warning btn-action btn-sm" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{url('/drivers')}}"> <span>Manage Drivers</span> </a></li>
                            
                            </ul>   
                    </div>
              </h3>

            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $drivers->count() }}</h5>
                    <span class="description-text">ALL</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $drivers_week->count() }}</h5>
                    <span class="description-text">WEEK</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $drivers_month->count() }}</h5>
                    <span class="description-text">MONTH</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $drivers_year->count() }}</h5>
                    <span class="description-text">YEAR</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

                <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user bg-aqua-active">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">

             <h3 class="widget-user-desc">
             Trucks

                  <div class="dropdown pull-right">
                        <a href="#" class="btn btn-info btn-action btn-sm" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{url('/trucks')}}"> <span>Manage Trucks</span> </a></li>
                            
                            </ul>   
                    </div>
             </h3>

            </div>

            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $trucks->count() }}</h5>
                    <span class="description-text">DAY</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $trucks_week->count() }}</h5>
                    <span class="description-text">WEEK</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $trucks_month->count() }}</h5>
                    <span class="description-text">MONTH</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $trucks_year->count() }}</h5>
                    <span class="description-text">YEAR</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>



          </div>
          <!-- /.widget-user -->
        </div>

                <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user bg-red-active">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red-active">

              <h3 class="widget-user-desc">
              Haulers
                  <div class="dropdown pull-right">
                        <a href="#" class="btn btn-danger btn-action btn-sm" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{url('/haulers')}}"> <span>Manage Haulers</span> </a></li>
                            
                            </ul>   
                    </div>
              </h3>

            </div>

            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $haulers->count() }}</h5>
                    <span class="description-text">DAY</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $haulers_week->count() }}</h5>
                    <span class="description-text">WEEK</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $haulers_month->count() }}</h5>
                    <span class="description-text">MONTH</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $haulers_year->count() }}</h5>
                    <span class="description-text">YEAR</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>


    </div><!-- end row -->

    <div class="row">

        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user bg-green-active">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green-active">

              <h3 class="widget-user-desc">
              Pickups
                  <div class="dropdown pull-right">
                        <a href="#" class="btn btn-success btn-action btn-sm" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{url('/pickups')}}"> <span>Manage Pickups</span> </a></li>
                            
                            </ul>   
                    </div>
              </h3>

            </div>

            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $pickups->count() }}</h5>
                    <span class="description-text">DAY</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $pickups_week->count() }}</h5>
                    <span class="description-text">WEEK</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $pickups_month->count() }}</h5>
                    <span class="description-text">MONTH</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{ $pickups_year->count() }}</h5>
                    <span class="description-text">YEAR</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
    </div><!-- end col-md-4 -->

</div><!-- end role -->


@endsection