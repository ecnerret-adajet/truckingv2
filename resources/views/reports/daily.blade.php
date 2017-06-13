@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Search Result</h4>
                                <p class="category">Truck summary report</p>
                                <hr/>
                                
                {{ Form::open(array('url' => '/generateDaily', 'method' => 'get')) }}
                <div class="row">



                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label>Search date</label>
                                {!! Form::input('date', 'start_date', Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control', 'max' => ''.Carbon\Carbon::now()->format('Y-m-d').'']) !!} 

                            @if ($errors->has('start_date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>                   
                     </div>


                    <div class="col-md-6">
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

        <div class="row" style="padding: 0 10px 0 10px">
            <div class="col-md-12">
                 {!! link_to_route('export_daily', 'Export Table', null, ['class' => 'btn btn-sm btn-primary btn-fill']) !!}            
            </div>
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
                                        <td> 
                                    
                                    @foreach($result->drivers as $driver)
                                    <img class="img-responsive img-circle" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}" style="display:block; margin: 10px auto; width: 50px; height: auto;">
                                    @endforeach
                                        
                                        
                                        </td>
                                        <td>

                                        <br/>
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
                                             @forelse($all_in_2->where('CardholderID', '==', $result->CardholderID)->take(1) as $in)
                                                <span class="label label-success">{{ $final_in = date('Y-m-d h:i:s A', strtotime($in->LocalTime))}} </span><br/>
                                            @empty
                                                NO IN
                                            @endforelse  
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
    