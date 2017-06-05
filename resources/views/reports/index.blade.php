<?php
    session_start();
    @$sel_hauler = $_GET["hauler_list"];
    @$sel_start = $_GET["start_date"];
    @$sel_end = $_GET["end_date"];
    $_SESSION["redirect_lnk"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Monitoring Summary </h4>
                                <p class="category">Truck summary report</p>
                                <hr/>
                                
                {{ Form::open(array('url' => '/generate', 'method' => 'get')) }}
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('hauler_list') ? ' has-error' : '' }}">
                         <label>Operator</label>
                         
                       {!! Form::select('hauler_list', $haulers, $sel_hauler, ['class' => 'form-control border-input ', 'placeholder' => '--- Assign an Operator ---'] ) !!}

                       @if ($errors->has('hauler_list'))
                        <span class="help-block">
                        <strong>{{ $errors->first('hauler_list') }}</strong>
                        </span>
                        @endif


                        </div>                   
                     </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label>Start date</label>
                                {!! Form::input('date', 'start_date', $sel_start, ['class' => 'form-control']) !!} 

                            @if ($errors->has('start_date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>                   
                     </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label>End date</label>
                                {!! Form::input('date', 'end_date', $sel_end, ['class' => 'form-control']) !!} 

                            @if ($errors->has('end_date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                            @endif
                        </div>                   
                     </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <label> &nbsp;</label>
                            <button class="btn btn-fill btn-primary btn-block" type="submit">
                                GENERATE
                            </button>
                        </div>                   
                     </div>
                </div>
            {!! Form::close() !!} 
                                
        </div><!-- end header -->

        <hr/>

                           <div class="content table-responsive table-full-width" id="feed">


                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                    <th>Hauler</th>
                                    <th>Driver</th>
                                    <th>Plate Number</th>

                                    @if(!empty($start_date) && !empty($end_date))
                                   @for ($x = $start_date; $x <= $end_date; $x++)
                                    <th class="text-center">
                                      {{ date('F d', strtotime($x)) }}
                                    </th>
                                    @endfor
                                    @endif


                                    </tr>
                                    </thead>

                                    <tbody>
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

     <!--                                           <td>
                                               @if(empty($today->monitors()->count()))
                                               <a href="{{url('/monitors/create/'.$today->LogID)}}" class="btn btn-sm btn-success">
                                               Create Status
                                               </a>
                                               @else

                                               @foreach($today->monitors as $monitor)
                                                <a href="{{url('/monitors/'.$monitor->id.'/edit/'.$today->LogID) }}" class="btn btn-sm btn-danger">
                                               Update Status
                                               </a>
                                               @endforeach

                                               @endif



                                               
                                               </td> -->
                                                @if(!empty($start_date) && !empty($end_date))
                                                @for ($x = $start_date; $x <= $end_date; $x++)
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

                                                           @foreach($trip->monitors as $monitor)
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
                                    </tbody>

                                </table>       


                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-6">
                                      <small>LEGEND:</small>
                                      <p>
                                          <i class="pe-7s-check" style="font-size: 25px; font-weight: bold; color: blue"></i> : <em> Trip found / Add truck status </em><br/>
                                          <i class="pe-7s-close-circle" style="font-size: 25px; font-weight: bold; color: red"></i> : <em> No trip found </em>
                                      </p>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                        

                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>            
@endsection
    