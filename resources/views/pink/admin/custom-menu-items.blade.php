                    	@foreach($items as $item)
	                    	<tr>
	                    		<td style="text-align:left">
	                    			{{ $paddingLeft }}
	                    			{!! Html::link(route('menus.edit', ['menu' => $item->id]), $item->title) !!}</td>
	                    		<td>{{ $item->url() }}</td>
	                    		<td>
	                    			{!! Form::open([
										'method' => 'DELETE', 
										'route' => ['menus.destroy', $item->id],
										'class' => 'form-horizontal',

										]) 
									!!}
									{!! Form::submit('Delete', ['class' => 'btn btn-french-5']) !!}
									{!! Form::close() !!}
	                    		</td>
	                    	</tr>
	                    	@if($item->hasChildren())
	                    			@include(env('THEME') . '.admin.custom-menu-items', ['items' => $item->children(), 'paddingLeft' => $paddingLeft . '--'])
	                    	@endif
                    	@endforeach