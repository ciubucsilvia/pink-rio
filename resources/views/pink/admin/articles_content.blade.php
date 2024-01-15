@if($articles)
	<div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Articles</h2>
            <div class="short-table white">
            	
            	{!! Html::link(route('articles.create'), 'Article add', ['class' => 'btn btn-identification-4']) !!}

                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Alias</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($articles as $article)
	                    	<tr>
	                    		<td>{{ $article->id }}</td>
	                    		<td>{!! Html::link(route('articles.edit', ['article' => $article->alias]), $article->title) !!}</td>
	                    		<td>{{ str_limit($article->text, 200) }}</td>
	                    		<td>
	                    		@if(isset($article->img->path))
	                    			{!! Html::image(env('THEME') . '/images/articles/' . $article->img->path) !!}
	                    		@endif
	                    		</td>
	                    		<td>{{ $article->category->title }}</td>
	                    		<td>{{ $article->alias }}</td>
	                    		<td>
	                    			{!! Form::open([
										'method' => 'DELETE', 
										'route' => ['articles.destroy', $article->alias],
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
        </div>
    </div>
@endif