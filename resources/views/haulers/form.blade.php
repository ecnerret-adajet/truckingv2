<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>Hauler Name</label>
            {!! Form::text('name', null,  ['class' => 'form-control border-input','placeholder' => 'Plate Number']) !!}

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
        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label>Hauler Address</label>
            {!! Form::text('address', null,  ['class' => 'form-control border-input','placeholder' => 'Vehicle Type']) !!}

                @if ($errors->has('address'))
                <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>


<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
            <label>Contact Number</label>
            {!! Form::text('contact_number', null,  ['class' => 'form-control border-input','placeholder' => 'contact number']) !!}

                @if ($errors->has('contact_number'))
                <span class="help-block">
                <strong>{{ $errors->first('contact_number') }}</strong>
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