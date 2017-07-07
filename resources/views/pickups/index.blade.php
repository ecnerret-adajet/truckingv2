@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$pickups->count()}}</h3>

              <p>Total Pickup Logs</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-photos-outline"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$pickups->count()}}</h3>

              <p>Current Pickup</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-photos-outline"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="title">All Pickup Trucks

                <a href="{{ url('/pickups/create') }}"  class="btn btn-primary btn-sm pull-right">
                Add New Pickup
                </a>
                </h4>


                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Age</th>
                            <th>Pickup #</th>
                            <th>Plate #</th>
                            <th>Driver Name</th>
                            <th>Company</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pickups as $pickcup)
                        <tr>
                            <td>
                                <span class="btn btn-success btn-xs">
                                    {{ Carbon\Carbon::parse($pickcup->LocalTime)->diffForHumans() }}      
                                </span>                        
                            </td>
                            <td>
                                {{$pickup->carholder->Name}}
                            </td>
                            <td>
                                {{$pickup->plate_number}}
                            </td>
                            <td>
                                {{$pickup->driver_name}}
                            </td>
                            <td>
                                {{$pickup->company}}
                            </td>
                            <td>
                            
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- end container fluid -->


@endsection