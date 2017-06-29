
                                   
                                    <div class="row">
                                    <div class="col-md-12">
                                           <div class="form-group{{ $errors->has('cardholder_list') ? ' has-error' : '' }}">
                                                <label>Assigned RFID</label>
                                               @if(str_contains(Request::path(), 'edit'))
                                                {!! Form::select('cardholder_list', $cardholders, $driver->cardholder->CardholderID, ['class' => 'form-control border-input multiple', 'placeholder' => '--- Assign a RFID ---'] ) !!}
                                                @else
                                                {!! Form::select('cardholder_list', $cardholders, null, ['class' => 'form-control border-input select', 'placeholder' => '--- Assign a RFID ---'] ) !!}
                                                @endif
                                                    @if ($errors->has('cardholder_list'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('cardholder_list') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                    </div>
                                    </div>

                                    <hr/>


         
<!--                                 <div class="row">
                                  <div class="col-md-12">
                                        <img class="img-circle img-responsive profile-row" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar)) }}" >
                                    </div>
                                </div> -->


                                <div class="row">
                                  <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                                <label>Avatar</label>
                                                 <input name="avatar" type="file" class="filestyle"  data-buttonName="btn-primary btn-fill" data-buttonBefore="true">


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
                                                <label>Assigned Operator</label>
                                                {!! Form::select('hauler_list', $haulers, null, ['class' => 'form-control border-input', 'placeholder' => '--- Assign an Operator ---'] ) !!}

                                                   @if ($errors->has('hauler_list'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('hauler_list') }}</strong>
                                                    </span>
                                                    @endif
                                               </div>
                                    </div>

                                    </div>





                                    <div class="row">

                                  <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('truck_list') ? ' has-error' : '' }}">
                                                <label>Plate Number</label>
                                                {!! Form::select('truck_list', $trucks, null, ['class' => 'form-control border-input multiple', 'placeholder' => '--- Assign a Truck ---'] ) !!}

                                                @if ($errors->has('truck_list'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('truck_list') }}</strong>
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
                                                {!! Form::text('driver_number', null,  ['class' => 'form-control border-input','placeholder' => 'Driver Number']) !!}

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
                                                {!! Form::text('name', null,  ['class' => 'form-control border-input','placeholder' => 'Full Name']) !!}

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                             <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                <label>Phone Number</label>
                                                {!! Form::text('phone_number', null,  ['class' => 'form-control border-input','placeholder' => 'Phone Number']) !!}

                                                @if ($errors->has('phone_number'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('substitute') ? ' has-error' : '' }}">
                                                <label>Subtitute</label>
                                                {!! Form::text('substitute', null,  ['class' => 'form-control border-input','placeholder' => 'Substitute']) !!}

                                                @if ($errors->has('substitute'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('substitute') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>





                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
                                    </div>
                                    <div class="clearfix"></div>