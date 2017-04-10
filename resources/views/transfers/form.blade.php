
                                <div class="row">
                                  <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                                <label>FROM TRUCK #</label>
                                                    @foreach($driver->trucks as truck)
                                                        {{ $truck->plate_number}}
                                                    @endforeach

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
                                            <div class="form-group{{ $errors->has('hauler_list') ? ' has-error' : '' }}">
                                                <label>TO TRUCK #</label>
                                                {!! Form::select('hauler_list', $trucks, null, ['class' => 'form-control border-input', 'placeholder' => '--- Assign an Operator ---'] ) !!}

                                                   @if ($errors->has('hauler_list'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('hauler_list') }}</strong>
                                                    </span>
                                                    @endif
                                               </div>
                                    </div>

                                    </div>





                                    <hr/>

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('driver_number') ? ' has-error' : '' }}">
                                                <label>Driver Number</label>
                                                {!! Form::input('date', 'expired_date', null,  ['class' => 'form-control border-input']) !!}

                                                @if ($errors->has('driver_number'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('driver_number') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Name</label>
                                                {!! Form::textarea('remarks', null,  ['class' => 'form-control border-input']) !!}

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>

                                    </div>








                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                    </div>
                                    <div class="clearfix"></div>