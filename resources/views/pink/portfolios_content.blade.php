<div id="content-page" class="content group">
        <div class="hentry group">
            <!-- <script>
                jQuery(document).ready(function($){
                	$('.sidebar').remove();
                	
                	if( !$('#primary').hasClass('sidebar-no') ) {
                		$('#primary').removeClass().addClass('sidebar-no');
                	}
                	
                });
            </script> -->
            @if($portfolios)
            <div id="portfolio" class="portfolio-big-image">
                @foreach($portfolios as $portfolio)
	                <div class="hentry work group">
	                    <div class="work-thumbnail">
	                        <div class="nozoom">
	                            <img src="{{ asset(env('THEME')) }}/images/projects/0061-770x368.jpg" alt="0061" title="0061" />							
	                            <div class="overlay">
	                                <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/projects/0061.jpg" rel="lightbox" title="{{ $portfolio->title }}"></a>
	                                <a class="overlay_project" href="{{ route('portfoliosShow', ['alias'=>$portfolio->alias]) }}"></a>
	                                <span class="overlay_title">{{ $portfolio->title }}</span>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="work-description">
	                        <h3>{{ $portfolio->title }}</h3>
	                        <p>{{ str_limit($portfolio->text, 150) }}</p>
	                        <div class="clear"></div>
	                        <div class="work-skillsdate">
	                            <p class="skills"><span class="label">{{ Lang::get('home.filter') }}</span>{{ $portfolio->filter->title }}</p>
	                            <p class="workdate"><span class="label">{{ Lang::get('home.customer') }}</span>{{ $portfolio->customer }}</p>

	                            @if($portfolio->created_at)
	                            	<p class="workdate"><span class="label">{{ Lang::get('home.date') }}</span>{{ $portfolio->created_at->format('Y') }}</p>
	                            @endif
	                        </div>
	                        <a class="read-more" href="{{ route('portfoliosShow', ['alias'=>$portfolio->alias]) }}">{{ Lang::get('home.view_project') }}</a>            
	                    </div>
	                    <div class="clear"></div>
	                </div>
	            @endforeach

	            <div class="general-pagination group">
			        @if($portfolios->lastPage() > 1)
			            
			            @if($portfolios->currentPage() !== 1)
			                <a href="{{ $portfolios->url($portfolios->currentPage() - 1) }}">{{ Lang::get('pagination.previous') }}</a>    
			            @endif

			            @for($i = 1; $i <= $portfolios->lastPage(); $i++)
			                @if($portfolios->currentPage() == $i)
			                    <a class="selected disabled">{{ $i }}</a>
			                @else
			                    <a href="{{ $portfolios->url($i) }}">{{ $i }}</a>
			                @endif
			            @endfor

			            @if($portfolios->currentPage() !== $portfolios->lastPage())
			                <a href="{{ $portfolios->url($portfolios->currentPage() + 1) }}">{{ Lang::get('pagination.next') }}</a>
			            @endif
			        @endif
			    </div>

            </div>
            @endif
            <div class="clear"></div>
        </div>

    </div>