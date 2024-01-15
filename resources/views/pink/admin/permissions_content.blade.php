<div id="content-page" class="content group">
	<div class="hentry group">
		<h2>Roles and Permissions</h2>

		{!! Form::open(['route' => 'permissions.store']) !!}

			<div class="short-table white">
				<table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Permissions</th>
                            @if(!$roles->isEmpty())
                            	@foreach($roles as $role)
                            		<th>{{ $role->name }}</th>
                            	@endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    	@if(!$privs->isEmpty())
                    		@foreach($privs as $priv)
                    			<tr>
                        			<td>{{ $priv->name }}</td>

                        			@if(!$roles->isEmpty())
		                            	@foreach($roles as $role)
		                            		<td>
		                            		@if($role->hasPermission($priv->name))
		                            			<input type="checkbox" checked name="{{ $role->id }}[]" value="{{ $priv->id }}">
		                            		@else 
		                            			<input type="checkbox"  name="{{ $role->id }}[]" value="{{ $priv->id }}">
		                            		@endif
		                            		</td>
		                            	@endforeach
		                            @endif
                        		</tr>
                        	@endforeach
                    	@endif
                    </tbody>
                 </table>
			</div>
            
            {!! Form::submit('Save', ['class' => 'btn btn-large  btn-view-over-the-town-5']) !!}

        {!! Form::close() !!}

	</div>
</div>