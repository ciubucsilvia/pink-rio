<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Create Article</h2>
        
        {!! Form::open(['route' => 'articles.store', 'files' => true]) !!}

            @include(env('THEME') . '.admin.articles_form_content')
            
            {!! Form::submit('Add article', ['class' => 'btn btn-large  btn-view-over-the-town-5']) !!}

        {!! Form::close() !!}

    </div>
</div>

<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
</script>
