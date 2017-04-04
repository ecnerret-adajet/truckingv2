<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
<div class="col-md-12 ">
<label class="control-label">
{!! Form::label('name', 'Role Name:') !!}
</label>
</div>

<div class="col-md-12">
{!! Form::text('name', null, ['class' => 'form-control'] ) !!}
@if ($errors->has('name'))
<span class="help-block">
<strong>{{ $errors->first('name') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
<div class="col-md-12 ">
<label class="control-label">
{!! Form::label('display_name', 'Display Name:') !!}
</label>
</div>

<div class="col-md-12">
{!! Form::text('display_name', null, ['class' => 'form-control'] ) !!}
@if ($errors->has('display_name'))
<span class="help-block">
<strong>{{ $errors->first('display_name') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
<div class="col-md-12 ">
<label class="control-label">
{!! Form::label('description', 'Description:') !!}
</label>
</div>

<div class="col-md-12">
{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3'] ) !!}
@if ($errors->has('description'))
<span class="help-block">
<strong>{{ $errors->first('description') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('permission_list') ? ' has-error' : '' }}">
<div class="col-md-12 ">
<label class="control-label">
{!! Form::label('permission', 'Permissions:') !!}
</label>
</div>

<div class="col-md-12">
@foreach($permission as $value)
    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
    {{ $value->display_name }}</label>
   
@endforeach  
@if ($errors->has('permission'))
<span class="help-block">
<strong>{{ $errors->first('permission') }}</strong>
</span>
@endif
</div>
</div>