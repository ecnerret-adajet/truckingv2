@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$count_today_log}}</h3>

            <p>Entries Today</p>
          </div>
          <div class="icon">
            <i class="ion ion-radio-waves"></i>
          </div>
          <a href="{{ url('/feed') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$all_drivers->count()}}</h3>

            <p>Total Drivers</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-person"></i>
          </div>
          <a href="{{ url('/drivers')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$all_trucks->count()}}</h3>

            <p>Total Trucks</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-bus"></i>
          </div>
          <a href="{{url('/trucks')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$all_haulers->count()}}</h3>

            <p>Total Haulers</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-navigate"></i>
          </div>
          <a href="{{url('/haulers')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->


    @include('component.test')


  </div><!-- end container -->
@endsection
