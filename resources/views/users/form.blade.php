
        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
        <label>Name</label>
        {!! Form::text('name', null,  ['class' => 'form-control border-input']) !!}  

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
        <div class="form-group">
        <label>Email</label>
        {!! Form::text('email', null,  [ 'type' => 'email', 'class' => 'form-control border-input']) !!}

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>
        </div>
        </div>


        <div class="row">
        <div class="col-md-12">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label>Password</label>
        <input id="password" type="password" class="form-control border-input" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        </div>
        </div>
        </div>


        <div class="row">
        <div class="col-md-12">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label>Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        </div>
        </div>
        </div>

        @role(('Administrator'))
      <div class="row">
        <div class="col-md-12">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label>Roles</label>
        @if(str_contains(Request::path(), 'create'))
            {!! Form::select('roles_list[]',  $roles, null,  ['class' => 'form-control', 'multiple']) !!}
        @else
            {!! Form::select('roles_list[]',  $roles,$userRole,  ['class' => 'form-control', 'multiple']) !!}
        @endif
                                  
        @if ($errors->has('roles_list'))
            <span class="help-block">
                <strong>{{ $errors->first('roles_list') }}</strong>
            </span>
        @endif
        </div>
        </div>
        </div>
        @endrole


    <div class="text-right">
        <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
    </div>
    <div class="clearfix"></div>