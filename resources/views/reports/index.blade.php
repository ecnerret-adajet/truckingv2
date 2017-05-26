@extends('layouts.app')

@section('content')
           <div class="container-fluid">
                
                <div class="row"> 
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Monitoring Summary</h4>
                                <p class="category">Truck summary report</p>
                                <hr/>
                                
                {{ Form::open(array('url' => '/generate', 'method' => 'get')) }}
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('hauler_list') ? ' has-error' : '' }}">
                         <label>Operator</label>
                         
                       {!! Form::select('hauler_list', $haulers, null, ['class' => 'form-control border-input ', 'placeholder' => '--- Assign an Operator ---'] ) !!}

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
                                {!! Form::input('date', 'start_date', null, ['class' => 'form-control']) !!} 

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
                                {!! Form::input('date', 'end_date', null, ['class' => 'form-control']) !!} 

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
                                


                                <table class="table">
                                    <thead>
                                    <tr>
                                    <th>Hauler</th>
                                    <th>Plate Number</th>
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
                                               @foreach($driver->trucks as $truck)
                                                    {{$truck->plate_number}}
                                               @endforeach
                                               </td>
                                 
                                        </tr>
                                               @endforeach
                                            @endforeach
                                    @endforeach
                                    </tbody>

                                </table>       
                        

                            </div>
                        </div>
                    </div>


                </div><!-- end row -->
            </div>            
@endsection
    