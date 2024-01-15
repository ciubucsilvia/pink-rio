<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Auth;
use Menu;
use Gate;

class AdminController extends Controller
{
    protected $p_rep; // portfolios_repository
    protected $a_rep; // articles_repository

    protected $user;

    protected $template;

    protected $content = FALSE;

    protected $title;

    protected $vars;

    public function __construct() {

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            if(!$this->user) {
                abort(404);
            }
           
            return $next($request);
        });       

    }

    public function renderOutput() {
    	$this->vars = array_add($this->vars, 'title', $this->title);

    	$menu = $this->getMenu();

    	$navigation = view(config('settings.theme') . '.admin.navigation')
    						->with('menu', $menu)
    						->render();

    	$this->vars = array_add($this->vars, 'navigation', $navigation);

    	if($this->content) {
			$this->vars = array_add($this->vars, 'content', $this->content); 
    	}

    	$footer = view(config('settings.theme') . '.admin.footer')
    						->render();

    	$this->vars = array_add($this->vars, 'footer', $footer);
        
    	return view($this->template)->with($this->vars);


    }

    public function getMenu() {
    	return Menu::make('admin', function($menu) {
            if(Gate::allows('VIEW_ADMIN_ARTICLES')) {

                $menu->add('Articles', array('url' => 'admin/articles'));    
            }
    		
    		$menu->add('Portfolios', array('url' => 'admin/portfolios'));
    		$menu->add('Menus', array('url' => 'admin/menus'));
    		$menu->add('Users', array('url' => 'admin/users'));
    		$menu->add('Permissions', array('url' => 'admin/permissions'));
    	});
    }
}
