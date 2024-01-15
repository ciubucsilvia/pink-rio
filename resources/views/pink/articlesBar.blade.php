   
    <div class="widget-first widget recent-posts">
        <h3>{{ Lang::get('home.latest_projects') }}</h3>
        <div class="recent-post group">
        @if(!$portfolios->isEmpty())
        	@foreach($portfolios as $portfolio)
        		<div class="hentry-post group">
	                <div class="thumb-img" style="width: 55px"><img src="{{asset(env('THEME'))}}/images/projects/001-55x55.png" alt="001" title="001" /></div>
	                <!-- $portfolio->img->mini -->
	                <!-- $portfolio->img->max -->
	                <div class="text">
	                    <a href="{{ route('portfoliosShow', ['alias'=>$portfolio->alias]) }}" title="{{ $portfolio->title }}" class="title">{{ $portfolio->title }}</a>
	                    <p>{{ str_limit($portfolio->text, 130) }} </p>
	                    <a class="read-more" href="{{ route('portfoliosShow', ['alias'=>$portfolio->alias]) }}">&rarr; {{ Lang::get('home.read_more') }}</a>
	                </div>
	            </div>
        	@endforeach
        @endif
	            
        </div>
    </div>
    
    @if(!$comments->isEmpty())
	    <div class="widget-last widget recent-comments">
	        <h3>{{ Lang::get('home.latest_comments') }}</h3>
	        <div class="recent-post recent-comments group">
	        
	            @foreach($comments as $comment)
		            <div class="the-post group">
		                <div class="avatar">
			                @set($hash, ($comment->email) ? md5($comment->email) : md5($comment->user->email))
			                <img alt="" src="https://www.gravatar.com/avatar/{{$hash}}?d=mm&s=55" class="avatar" />
		                </div>
		                <span class="author"><strong><a href="#">{{ isset($comment->user) ? $comment->user->name : $comment->name }}</a></strong> in</span> 
		                <a class="title" href="{{ route('articlesShow', ['alias' => $comment->article->alias]) }}">{{ $comment->article->title }}</a>
		                <p class="comment">
		                    {!! str_limit($comment->text, 130) !!} <a class="goto" href="{{ route('articlesShow', ['alias' => $comment->article->alias]) }}">&#187;</a>
		                </p>
		            </div>
		        @endforeach
	            
	        </div>
	    </div>
	@endif
    
