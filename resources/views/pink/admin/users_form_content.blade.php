<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('name') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('login', 'Login', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('login') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('email') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::password('password') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Repeta Password', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::password('password_confirmation') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('role_id', 'Role', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('role_id', $roles) !!}
    </div>
</div>