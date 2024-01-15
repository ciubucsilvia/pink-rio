<div id="content-page" class="content group">
	<div class="hentry group">
		<h2>Users</h2>

        @if($users)
        
			<div class="short-table white">
                
                {!! Html::link(route('users.create'), 'User add', ['class' => 'btn btn-identification-4']) !!}

				<table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login</th>
                            <th>Role</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{!! Html::link(route('users.edit', ['user' => $user->id]), $user->name) !!}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->login }}</td>
                                <td>{{ $user->roles->implode('name', ', ') }}</td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE', 
                                        'route' => ['users.destroy', $user->id],
                                        'class' => 'form-horizontal',

                                        ]) 
                                    !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-french-5']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
			</div>
        
        @endif
	</div>
</div>