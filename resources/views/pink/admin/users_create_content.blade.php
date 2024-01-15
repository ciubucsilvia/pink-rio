<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Create User</h2>
        
        {!! Form::open(['route' => 'users.store']) !!}
        	
            @include(env('THEME') . '.admin.users_form_content')
            
            {!! Form::submit('Add User', ['class' => 'btn btn-large  btn-view-over-the-town-5']) !!}

        {!! Form::close() !!}

    </div>
</div>
