<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('plate_number') ? ' has-error' : '' }}">
            <label>Plate Number</label>
            {!! Form::text('plate_number', null,  ['class' => 'form-control border-input','placeholder' => 'Plate Number']) !!}

                @if ($errors->has('plate_number'))
                <span class="help-block">
                <strong>{{ $errors->first('plate_number') }}</strong>
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







<div class="pull-right">
<button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
</div>
<div class="pull-left">
<a href="{{url('/trucks')}}" class="btn btn-default btn-fill btn-wd">Cancel</a>
</div>
<div class="clearfix"></div>