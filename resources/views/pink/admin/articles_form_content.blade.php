<div class="form-group">
    {!! Form::label('title', 'Title post', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('title') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('alias', 'Alias', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('alias') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categories') !!}
    <div class="col-md-10">
        {!! Form::select('category_id', $categories) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('keywords', 'Keywords') !!}
    <div class="col-md-10">
        {!! Form::text('keywords') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_desc', 'Meta description') !!}
    <div class="col-md-10">
        {!! Form::textarea('meta_desc') !!}
    </div>
</div>

@if(isset($article->img->path))
    <div class="form-group">
        {!! Form::label('img', 'Image article') !!}
        <div class="col-md-10">
            {!! Html::image(asset(env('THEME')) . '/images/articles/' . $article->img->path) !!}
            {!! Form::hidden('old_image', $article->img->path) !!}
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('img', 'Image') !!}
    <div class="col-md-10">
        {!! Form::file('img', ['class' => 'filestyle']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Description post') !!}
    <div class="col-md-10">
        {!! Form::textarea('description', null, ['id'=>'editor2']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('text', 'Body post') !!}
    <div class="col-md-10">
        {!! Form::textarea('text', null, ['id'=>'editor']) !!}
    </div>
</div>