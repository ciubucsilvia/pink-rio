<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Menu;

class SiteController extends Controller
{
    protected $p_rep; //portfolios_repositories
    protected $s_rep; //sliders_repositories
    protected $a_rep; //articles_repositories
    protected $m_rep; //menus_repositories
    protected $c_rep; //comments_repositories

    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template;
    protected $vars = [];

    protected $bar = 'no';

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;

    public function __construct(MenusRepository $m_rep){
    	$this->m_rep = $m_rep;
    }

    protected function renderOutput(){

    	$menu = $this->getMenu();

    	$navigation = view(env('THEME') . '.navigation')->withMenu($menu)->render();

    	$this->vars = array_add($this->vars, 'navigation', $navigation);

        if($this->contentRightBar){
            $rightBar = view(env('THEME') . '.rightBar')
                            ->with('content_rightBar', $this->contentRightBar)
                            ->render();

            $this->vars = array_add($this->vars, 'rightBar', $rightBar);
        }

        if($this->contentLeftBar){
            $leftBar = view(env('THEME') . '.leftBar')
                            ->with('content_leftBar', $this->contentLeftBar)
                            ->render();

            $this->vars = array_add($this->vars, 'leftBar', $leftBar);
        }

        $this->vars = array_add($this->vars, 'bar', $this->bar);

        $footer = view(env('THEME') . '.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);
    	
    	return view($this->template)->with($this->vars);
    }

    public function getMenu(){
    	$menu = $this->m_rep->get();

        $mBuilder = Menu::make('MyNav', function($m) use ($menu) {
            foreach($menu as $item) {
                if($item->parent == 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
 
    	return $mBuilder;
    }

}
