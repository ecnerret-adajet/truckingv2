
                                <div class="row">
                                  <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                                <label>FROM TRUCK #</label>
                                                <span class="form-control border-input">
                                                @foreach($driver->trucks as $truck)
                                                    {{$truck->plate_number}}
                                                @endforeach
                                                </span>

                                                   @if ($errors->has('avatar'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('avatar') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                    </div>
                                    </div>



                                    <div class="row">

                                  <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('to_truck') ? ' has-error' : '' }}">
                                                <label>TO TRUCK #</label>
                                                {!! Form::select('to_truck', $trucks, null, ['class' => 'form-control border-input reassign', 'placeholder' => 'Re-assign a truck']) !!}

                                                   @if ($errors->has('to_truck'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('to_truck') }}</strong>
                                                    </span>
                                                    @endif
                                               </div>
                                    </div>

                                    </div>





                                    <hr/>

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                                                <label>Return Date</label>
                                                {!! Form::input('date', 'return_date', null, ['class' => 'form-control border-input']) !!}
                                                @if ($errors->has('return_date'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('return_date') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Remarks</label>
                                                {!! Form::textarea('remarks', null, ['class' => 'form-control border-input', 'rows' => '3']) !!}

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>

                                    </div>








                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
                                    </div>
                                    <div class="clearfix"></div>