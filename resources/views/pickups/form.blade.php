
<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('cardholder_list') ? ' has-error' : '' }}">
            <label>Pickup Cards</label>
            {!! Form::select('cardholder_list', $cardholders, null, ['class' => 'form-control border-input select', 'placeholder' => '--- Assign a RFID ---'] ) !!}
                @if ($errors->has('cardholder_list'))
                <span class="help-block">
                <strong>{{ $errors->first('cardholder_list') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>

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
        <div class="form-group{{ $errors->has('driver_name') ? ' has-error' : '' }}">
            <label>Driver Name</label>
            {!! Form::text('driver_name', null,  ['class' => 'form-control border-input','placeholder' => 'Driver Name']) !!}

            @if ($errors->has('driver_name'))
                <span class="help-block">
                <strong>{{ $errors->first('driver_name') }}</strong>
                </span>
                @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
            <label>Company</label>
            {!! Form::text('company', null,  ['class' => 'form-control border-input','placeholder' => 'Company']) !!}

            @if ($errors->has('company'))
                <span class="help-block">
                <strong>{{ $errors->first('company') }}</strong>
                </span>
                @endif
        </div>
    </div>
</div>


<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
            <label>Remarks</label>
            {!! Form::textarea('remarks', null,  ['class' => 'form-control border-input','rows' => '3', 'placeholder' => 'Remarks']) !!}

                @if ($errors->has('remarks'))
                <span class="help-block">
                <strong>{{ $errors->first('remarks') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>


<div class="pull-right">
<button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
</div>
<div class="pull-left">
<a href="{{url('/pickups')}}" class="btn btn-default btn-fill btn-wd">Cancel</a>
</div>
<div class="clearfix"></div>