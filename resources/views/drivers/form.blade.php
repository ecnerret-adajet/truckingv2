
                                    <div class="row">

                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Assigned RFID</label>
                                               @if(str_contains(Request::path(), 'edit'))
                                                {!! Form::select('cardholder_list', $cardholders, $driver->cardholder->CardholderID, ['class' => 'form-control border-input select', 'placeholder' => '--- Assign a RFID ---'] ) !!}
                                                @else
                                                {!! Form::select('cardholder_list', $cardholders, null, ['class' => 'form-control border-input select', 'placeholder' => '--- Assign a RFID ---'] ) !!}
                                                @endif
                                            </div>
                                    </div>
                                    </div>

                                    <hr/>

                                    <div class="row">

                                  <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Assigned Operator</label>
                                                {!! Form::select('hauler_list', $haulers, null, ['class' => 'form-control border-input', 'placeholder' => '--- Assign an Operator ---'] ) !!}
                                            </div>
                                    </div>

                                    </div>





                                    <div class="row">

                                  <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Plate Number</label>
                                                {!! Form::select('truck_list', $trucks, null, ['class' => 'form-control border-input', 'placeholder' => '--- Assign a Truck ---'] ) !!}
                                            </div>
                                    </div>

                                    </div>

                                    <hr/>

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Driver Number</label>
                                                {!! Form::text('driver_number', null,  ['class' => 'form-control border-input','placeholder' => 'Full Name']) !!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                {!! Form::text('name', null,  ['class' => 'form-control border-input','placeholder' => 'Full Name']) !!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                {!! Form::text('phone_number', null,  ['class' => 'form-control border-input','placeholder' => 'Phone Number']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Subtitute</label>
                                                {!! Form::text('substitute', null,  ['class' => 'form-control border-input','placeholder' => 'Substitute']) !!}
                                            </div>
                                        </div>
                                    </div>





                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                    </div>
                                    <div class="clearfix"></div>