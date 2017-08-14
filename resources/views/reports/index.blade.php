<?php
    session_start();
    @$sel_hauler = $_GET["hauler_list"];
    @$sel_start = $_GET["start_date"];
    @$sel_end = $_GET["end_date"];
    $_SESSION["redirect_lnk"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(!empty( $_GET["start_date"]) || !empty( $_GET["end_date"]) || !empty( $_GET["hauler_list"])) {
        $_SESSION["start_date"] = $_GET["start_date"];
        $_SESSION["end_date"] = $_GET["end_date"];
        $_SESSION["hauler_list"] = $_GET["hauler_list"];
    }

?>
@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                         <div class="panel panel-default" style="border: 0; padding: 30px;">
                            <div class="header">
                                <h3 class="title">Monitoring Summary </h3>
                                <p class="text-muted">Truck summary report</p>
                                <hr/>
                

                <div class="row">
                        <div class="col-md-12">
                               @if (session('status')) 
                            <div class="alert alert-dismissible alert-warning" style="border-radius: 0 ! important;">
                                <button type="button" class="close" style="color: black" data-dismiss="alert">&times;</button>
                                <strong>Oh snap!</strong>   {{ session('status') }}
                                </div>
                            @endif
                        </div>
                </div>



                                
                {{ Form::open(array('url' => '/generate', 'method' => 'get')) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('hauler_list') ? ' has-error' : '' }}">
                         <label>Operator</label>
                         
                       {!! Form::select('hauler_list[]', $haulers, $sel_hauler, ['class' => 'form-control border-input multiple-hauler', 'multiple'=>'multiple'] ) !!}

                       @if ($errors->has('hauler_list'))
                        <span class="help-block">
                        <strong>{{ $errors->first('hauler_list') }}</strong>
                        </span>
                        @endif


                        </div>                   
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label>Start date</label>
                                {!! Form::input('date','start_date', $sel_start, ['class' => 'form-control']) !!} 

                            @if ($errors->has('start_date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>                   
                     </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label>End date</label>
                                {!! Form::input('date', 'end_date', $sel_end, ['class' => 'form-control', 'max' => ''.date('Y-m-d', strtotime(Carbon\Carbon::now())).'' ]) !!} 

                            @if ($errors->has('end_date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                            @endif
                        </div>                   
                     </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label> &nbsp;</label>
                            <button class="btn  btn-primary btn-block" type="submit">
                                GENERATE
                            </button>
                        </div>                   
                     </div>
                </div>
            {!! Form::close() !!} 
                                
        </div><!-- end header -->

        </div><!-- end panel default -->



         <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Results Table</h3>


        





              <div class="box-tools">
                

    
                        @if(Request::is('generate'))
                        <div class="dropdown pull-right">
                        <a href="#" class="btn btn-default btn-action btn-sm" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{url('/summaryExport')}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Save as Excel</span> </a></li>
                            
                        </ul>   
                        </div>
                        @endif
         
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                                    <tr>
                                    <th>Hauler</th>
                                    <th>Driver</th>
                                    <th>Plate Number</th>

                                    @if(!empty($start_date) && !empty($end_date))
                                 
                                    @for ($x = $start_date; $x <= $end_date; $x=date('Y-m-d', strtotime($x. ' + 1 days')))
                                    <th class="text-center">
                                      {{ date('F d', strtotime($x)) }}
                                    </th>
                                    @endfor
                                    @endif


                                    </tr>
   @foreach($today_result as $today)
                                        @foreach($today->drivers as $driver)
                                                @foreach($driver->haulers as $hauler)
                                        <tr>
                                                <td>
                                                    {{$hauler->name}}
                                               </td>

                                               <td>
                                                    {{$driver->name}}
                                               </td>

                                               <td>
                                               @foreach($driver->trucks as $truck)
                                                    {{$truck->plate_number}}
                                               @endforeach
                                               </td>

                                                @if(!empty($start_date) && !empty($end_date))
                                                @for ($x = $start_date; $x <= $end_date; $x=date('Y-m-d', strtotime($x. ' + 1 days')))
                                                <td class="text-center">     
                                                @forelse(App\Log::where('CardholderID',$today->CardholderID)
                                                    ->whereDate('LocalTime' ,Carbon\Carbon::parse($x))
                                                  ->orderBy('LocalTime','ASC')
                                                  ->get() as $value => $trip)
                                                  @if($value == 0)

                                                       

                                                            @if(empty($trip->monitors()->count()))
                                                           <a href="{{url('/monitors/create/'.$trip->LogID)}}">
                                                              <i class="pe-7s-check" style="font-size: 25px; font-weight: bold"></i>
                                                           </a>
                                                           @else

                                                           @foreach($trip->monitors->reverse()->take(1) as $monitor)
                                                            <a href="{{url('/monitors/'.$monitor->id.'/edit/'.$trip->LogID) }}" class="btn btn-sm btn-danger">
                                                           Update Status
                                                           </a>
                                                           @endforeach

                                                           @endif

                                                  @endif
                                                
                                                @empty

                                                <i class="pe-7s-close-circle" style="font-size: 25px; font-weight: bold; color: red">

                                                @endforelse




                                                </td>
                                                @endfor
                                                @endif
                                 
                                        </tr>


                                               @endforeach
                                            @endforeach
                                    @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


                        </div>
                    </div>


                </div><!-- end row -->
            </div>            
@endsection

@section('script')

<script type="text/javascript">
$(".multiple-hauler").select2();
</script>

@endsection
    