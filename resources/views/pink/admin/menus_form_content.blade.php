<img src="{{ asset(env('THEME')) }}/images/menu/0_menus_add_edit.png">
<img src="{{ asset(env('THEME')) }}/images/menu/menus_add_edit.png">
<ul>
    <li class="text-field">
        {!! Form::label('title', 'Title post', ['class' => 'name-contact-us']) !!}
        <div class="input-prepend">
            {!! Form::text('title') !!}
        </div>
    </li>
    <li class="text-field">
        {!! Form::label('parent', 'Parent item menu', ['class' => 'name-contact-us']) !!} <br>
        {!! Form::label('parent', 'Parent:', ['class' => 'name-contact-us']) !!}
        <div class="input-prepend">
             {!! Form::select('parent', $menus); !!}
        </div>
    </li>
</ul>

<h1>Tip menu:</h1>
<div id="accordion">
    <h3>{!! Form::radio('type', 'customLink') !!}
        {!! Form::label('type', 'Users link', ['class' => 'name-contact-us']) !!}</h3>
    <ul>
        <li class="text-field">
            {!! Form::label('parent', 'Link item menu', ['class' => 'name-contact-us']) !!} <br>
            {!! Form::label('sublabel', 'Link item:', ['class' => 'name-contact-us']) !!}
            <div class="input-prepend">
                 {!! Form::text('custom_link', null, ['placeholder' => 'Type hier title page']) !!}
            </div>
        </li>
    </ul>

    <h3>{!! Form::radio('type', 'blogLink') !!}
        {!! Form::label('type', 'Blog link', ['class' => 'name-contact-us']) !!}</h3>
    <ul>
        <li class="text-field">
            {!! Form::label('parent', 'Link to category blog', ['class' => 'name-contact-us']) !!} <br>
            {!! Form::label('sublabel', 'Link to category blog:', ['class' => 'name-contact-us']) !!}
            <div class="input-prepend">
                 {!! Form::select('category_alias', $categories); !!}
            </div>
        </li>
    </ul>

    <h3>{!! Form::radio('type', 'ArticlesLink') !!}
        {!! Form::label('type', 'Articles link', ['class' => 'name-contact-us']) !!}</h3>
    <ul>
        <li class="text-field">
            {!! Form::label('parent', 'Link to Articles', ['class' => 'name-contact-us']) !!} <br>
            {!! Form::label('sublabel', 'Link to Articles:', ['class' => 'name-contact-us']) !!}
            <div class="input-prepend">
                 {!! Form::select('article_alias', $articles); !!}
            </div>
        </li>
    </ul>

    <h3>{!! Form::radio('type', 'PortfolioLink') !!}
        {!! Form::label('type', 'Portfolio link', ['class' => 'name-contact-us']) !!}</h3>
    <ul>
        <li class="text-field">
            {!! Form::label('parent', 'Link to Portfolio', ['class' => 'name-contact-us']) !!} <br>
            {!! Form::label('sublabel', 'Link to Portfolio:', ['class' => 'name-contact-us']) !!}
            <div class="input-prepend">
                 {!! Form::select('portfolio_alias', $portfolios); !!}
            </div>
        </li>
    </ul>

     <h3>{!! Form::radio('type', 'FiltersLink') !!}
        {!! Form::label('type', 'Filters link', ['class' => 'name-contact-us']) !!}</h3>
    <ul>
        <li class="text-field">
            {!! Form::label('parent', 'Link to Filters', ['class' => 'name-contact-us']) !!} <br>
            {!! Form::label('sublabel', 'Link to Filters:', ['class' => 'name-contact-us']) !!}
            <div class="input-prepend">
                 {!! Form::select('filter_alias', $filters); !!}
            </div>
        </li>
    </ul>
    
</div>
