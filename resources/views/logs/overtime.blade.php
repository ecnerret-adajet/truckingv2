@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                Overtime Trucks
                                <a class="btn btn-primary btn-sm pull-right" href="{{url('/home')}}">
                                    Back to Dashboard
                                </a>
                                 </h4>



                                <p class="category">All Trucks within the plant</p>


                    
                     <hr/>

            {{ Form::open(array('url' => '/report', 'method' => 'get')) }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label>Start date</label>
                                {!! Form::input('date', 'start_date', null, ['class' => 'form-control']) !!} 

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
                                {!! Form::input('date', 'end_date', null, ['class' => 'form-control']) !!} 

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
                            <button class="btn btn-fill btn-primary btn-block" type="submit">
                                GENERATE
                            </button>
                        </div>                   
                     </div>
                </div>
            {!! Form::close() !!} 

                            </div>
                            <div class="content table-responsive table-full-width" id="feed">


                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Driver Name</th>
                                        <th>Plate Number</th>
                                        <th>Operator</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>Time between</th>
                                    </tr>
                                </thead>
                                <tbody>


                                <?php 
                                $i = 1; 
                                
                                ?>
                                @foreach($today_result as $result)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            @foreach($result->drivers as $driver)
                                                    <a href="{{url('/drivers/'.$driver->id)}}"> 
                                                    {{  $driver->name }}
                                                    </a>
                                            @endforeach  
                                        </td>   
                                        <td>
                                        @foreach($result->drivers as $driver)
                                                    @foreach($driver->trucks as $truck)
                                                        {{$truck->plate_number}}
                                                    @endforeach
                                            @endforeach
                                        </td>   
                                        <td>
                                        @foreach($result->drivers as $driver)
                                                        @foreach($driver->haulers as $hauler)
                                                            {{$hauler->name}}
                                                        @endforeach
                                        @endforeach                                         
                                        
                                        </td>   


                                        
                                        <td>
                                        <?php $final_in = ''; ?>
                                        @forelse($all_in->where('CardholderID', '==', $result->CardholderID)->take(1) as $in)
                                            <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                        @empty
                                            NO IN
                                        @endforelse     
                                          
                                        </td>   
                                             
                                        <td>
                                        <?php $final_out = ''; ?>                                     
                                        @forelse($all_out->where('CardholderID', '==', $result->CardholderID)->take(1) as $out)
                                                    <span class="label label-warning">{{ $final_out = date('Y-m-d h:i:s A', strtotime($out->LocalTime))}} </span><br/>
                                        @empty
                                        NO OUT
                                        @endforelse   
                                        </td> 
                                       
                                        <td>

                                         @forelse($all_out->where('CardholderID', '==', $result->CardholderID)->take(1) as $out )
                                         	@forelse($all_in->where('CardholderID', '==', $result->CardholderID)->take(1) as $in )
                                       			{{  $in->LocalTime->diffInHours($out->LocalTime)}} Hour(s)
                                       		@empty
                                       			NO PAIRED TIME IN
                                       		@endforelse
                                         @empty
			                                  NO PAIRED TIME OUT
                                         @endforelse




                                           
                                     
                                           
                                        </td>      
                                    </tr>                        
                                @endforeach  


                                </tbody>
                            </table>


                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>            
@endsection
