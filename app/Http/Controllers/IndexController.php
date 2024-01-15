<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\SlidersRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Config;

class IndexController extends SiteController
{
    public function __construct(SlidersRepository $s_rep, PortfoliosRepository $p_rep, ArticlesRepository $a_rep){
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->s_rep = $s_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;

        $this->bar = 'right';
        $this->template = env('THEME') . '.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        $this->title = 'Home Page';

        // SLIDER
        $slidersItems = $this->getSliders();

        $sliders = view(env('THEME') . '.slider')
                        ->with('sliders',  $slidersItems)
                        ->render();

        $this->vars = array_add($this->vars, 'sliders', $sliders);

        
        // PORTFOLIO
        $portfolios = $this->getPortfolio();

        $content = view(env('THEME') . '.content')
                        ->with('portfolios', $portfolios)
                        ->render();

        $this->vars = array_add($this->vars, 'content', $content);

        // SIDEBAR
        $articles = $this->getArticles();

        $this->contentRightBar = view(env('THEME') . '.indexBar')
                                    ->with('articles', $articles)
                                    ->render();


        return $this->renderOutput();
    }

    public function getSliders(){
        $sliders = $this->s_rep->get();

        if($sliders->isEmpty()) {
            return FALSE;
        }

        $sliders->transform(function($item, $key) {
            $item->img = Config::get('settings.slider_path') . '/' . $item->img;
            return $item;
        });

        return $sliders;
    }

    protected function getPortfolio() {
        $portfolio = $this->p_rep->get('*', Config::get('settings.home_port_count'));
        
        return $portfolio;
    }

    protected function getArticles(){
        $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias'], Config::get('settings.home_articles_count'));

        return $articles;
    }
}
