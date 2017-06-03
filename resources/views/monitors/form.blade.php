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


<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('odometer') ? ' has-error' : '' }}">
            <label>Odometer</label>
            {!! Form::text('odometer', null,  ['class' => 'form-control border-input','placeholder' => 'Odometer']) !!}

                @if ($errors->has('odometer'))
                <span class="help-block">
                <strong>{{ $errors->first('odometer') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>



<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('location_list') ? ' has-error' : '' }}">
            <label>Location</label>
            {!! Form::select('location_list', $locations, $monitor->location_id, ['class' => 'form-control border-input', 'placeholder' => 'Truck Location']) !!}

                @if ($errors->has('location_list'))
                <span class="help-block">
                <strong>{{ $errors->first('location_list') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>


<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('status_list') ? ' has-error' : '' }}">
            <label>Status</label>
            {!! Form::select('status_list', $statuses, $monitor->status_id, ['class' => 'form-control border-input', 'placeholder' => 'Trucks Status']) !!}

                @if ($errors->has('status_list'))
                <span class="help-block">
                <strong>{{ $errors->first('status_list') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>


<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('duration_list') ? ' has-error' : '' }}">
            <label>Duration</label>
            {!! Form::select('duration_list', $durations, $monitor->duration_id, ['class' => 'form-control border-input', 'placeholder' => 'Truck Duration']) !!}

                @if ($errors->has('duration_list'))
                <span class="help-block">
                <strong>{{ $errors->first('duration_list') }}</strong>
                </span>
                @endif
        </div>
</div>
</div>



<div class="row">
<div class="col-md-12">
        <div class="form-group{{ $errors->has('detail_list') ? ' has-error' : '' }}">
            <label>Details</label>
            {!! Form::select('detail_list', $details, $monitor->detail_id, ['class' => 'form-control border-input', 'placeholder' => 'Truck Details']) !!}

                @if ($errors->has('detail_list'))
                <span class="help-block">
                <strong>{{ $errors->first('detail_list') }}</strong>
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