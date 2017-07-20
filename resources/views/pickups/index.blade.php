@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xs-4">
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
        
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$current_pickup->count()}}</h3>

              <p>Current Pickup</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-photos-outline"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $available_card->count() }}</h3>

              <p>Available Card</p>
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
                            <th>IN</th>
                            <th>OUT</th>
                            <th>BETWEEN</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pickups as $pick)
                        <tr>
                            <td>
                                <span class="btn btn-success btn-xs">
                                    {{ $pick->created_at->diffForHumans() }}      
                                </span>                        
                            </td>
                            <td>
                                {{$pick->cardholder->Name}}
                            </td>
                            <td>
                                {{$pick->plate_number}}
                            </td>
                            <td>
                                {{$pick->driver_name}}
                            </td>
                            <td>
                                {{$pick->company}}
                            </td>


                            <td>

                                @forelse(App\Log3::pickupIn($pick->cardholder_id, $pick->created_at)->get() as $logIn)
                                    {{ $pick_in = date('F-d-y h:i:s A',strtotime($logIn->LocalTime))}}<br/>
                                @empty
                                    NO IN
                                @endforelse

                            </td>
                            <td>
                                @forelse(App\Log::pickupOut($pick->cardholder_id, $pick->created_at)->get() as $logOut)

                                @forelse(App\Log::pickupIn($pick->cardholder_id, $pick->created_at)->get() as $logIn)

                                    @if($logOut->LocalTime > $logIn->LocalTime)
                                       {{ $pick_out = date('F-d-y h:i:s A',strtotime($logOut->LocalTime)) }}
                                    @else
                                        NO OUT
                                    @endif

                                @empty
                                        CANNOT DETERMINE
                                @endforelse
                                @empty
                                        NO OUT
                                @endforelse
                            </td>
                            <td>

                                @forelse(App\Log::pickupOut($pick->cardholder->CardholderID, $pick->created_at)->get() as $logOut)
                                      {{  $logIn->LocalTime->diffInHours($logOut->LocalTime)}} Hour(s)
                                @empty
                                        NO OUT
                                @endforelse
                            </td>
                            <td>
                                @if($pick->availability == 1)
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
                                <div class="dropdown pull-right">
                                    <a href="#" class="btn btn-action btn-sm btn-primary" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu">
                                        <li><a href="{{url('/pickups/'.$pick->id.'/edit')}}"> <span>Edit Entry</span> </a></li>
                                        @if($pick->availability == 1) 
                                        <li><a data-toggle="modal" data-target=".bs-setInactive{{$pick->id}}-modal-lg" href=""> <span>Deactive RFID</span> </a></li>
                                        @endif
                                        </ul>   
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <ul class="pagination">
                    {{ $pickups->render() }}
                </ul>

            </div>
        </div>
    </div>
</div><!-- end container fluid -->

  @foreach($pickups as $pick)
        <!-- Change availabitlity status to inactive -->
        <div class="modal fade bs-setInactive{{$pick->id}}-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Deactive Pickup RFID</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-body text-center"> 
                                    <p>  
                                        Are you sure you want to proceed with this action?
                                    </p>                                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ url('/pickups/deactivate/'.$pick->id) }}">
                            {!! csrf_field() !!}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button> 
                        </form>                    
                    </div>
                                
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->   
  @endforeach


@endsection