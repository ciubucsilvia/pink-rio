<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Edit User</h2>
        
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

            @include(env('THEME') . '.admin.users_form_content')
            
            {!! Form::submit('Update user', ['class' => 'btn btn-large  btn-view-over-the-town-5']) !!}

        {!! Form::close() !!}

    </div>
</div>
