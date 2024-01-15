<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Edit Article</h2>
        
        {!! Form::model($article, ['route' => ['articles.update', $article->alias], 'method' => 'PUT', 'files' => true]) !!}

            @include(env('THEME') . '.admin.articles_form_content')
            
            {!! Form::submit('Update article', ['class' => 'btn btn-large  btn-view-over-the-town-5']) !!}

        {!! Form::close() !!}

    </div>
</div>

<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
</script>
