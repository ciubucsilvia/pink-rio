<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Http\Requests\MenusRequest;
use Gate;
use Menu;

class MenusController extends AdminController
{
    protected $m_rep; // menus_repository

    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep) {
        
        parent::__construct();

        $this->middleware(function($request, $next) {
            if(Gate::denies('VIEW_ADMIN_MENU')) {
                abort(403, 'Unauthorized action.');
            }
           
            return $next($request);
        }); 

        $this->m_rep = $m_rep;
        $this->a_rep = $a_rep;
        $this->p_rep = $p_rep;

        $this->template = env('THEME') . '.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Manager menus';

        $menu = $this->getMenus();

        $this->content = view(env('THEME') . '.admin.menus_content')
                                ->withMenu($menu)
                                ->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'New item menu';

        $tmp = $this->getMenus()->roots();
        $menus = $tmp->reduce(function($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;

            return $returnMenus;

        }, ['0' => 'Parent item menu']);

        $categories = \Corp\Category::select('id', 'title', 'alias', 'parent_id')->get();

        $list = [];
        $list = array_add($list, '0', 'No used');
        $list = array_add($list, 'parent', 'Section Blog');

        foreach ($categories as $category) {
            if($category->parent_id == 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->a_rep->get(['id', 'title', 'alias']);

        $articles = $articles->reduce(function($returnArticles, $article) {

            $returnArticles[$article->alias] = $article->title;

            return $returnArticles;

        }, []);

        $filters = \Corp\Filter::select('id', 'title', 'alias')->get()->reduce(function($returnFilters, $filter) {

            $returnFilters[$filter->alias] = $filter->title;

            return $returnFilters;
        }, ['parent' => 'Section Portfolio']);

        $portfolios = $this->p_rep->get(['id', 'title', 'alias'])->reduce(function($returnPortfolios, $portfolio) {

            $returnPortfolios[$portfolio->alias] = $portfolio->title;

            return $returnPortfolios;
        }, []);

        $this->content = view(env('THEME') . '.admin.menus_create_content')
                        ->withMenus($menus)
                        ->withCategories($list)
                        ->withArticles($articles)
                        ->withFilters($filters)
                        ->withPortfolios($portfolios)
                        ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $result = $this->m_rep->addMenu($request);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\Corp\Menu $menu)
    {
        // dd($menu);

        $this->title = 'Edit item menu';

        $type = FALSE;
        $option = FALSE;

        $route = app('router')->getRoutes()->match(app('request')->create($menu->path));

        $aliasRoute = $route->getName();
        $parameters = $route->parameters();

        if($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat') {
            
            $type = 'blogLink';
            $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';

        } else if($aliasRoute = 'articles.show') {
            $type = 'blogLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';            

        } else if($aliasRoute == 'portfolios.index') {
            $type = 'portfolioLink';
            $option = 'parent';
        
        } else if($aliasRoute == 'portfolios.show') {
            $type = 'portfolioLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';
        } else {
            $type = 'customLink';
        }


        $tmp = $this->getMenus()->roots();
        $menus = $tmp->reduce(function($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;

            return $returnMenus;

        }, ['0' => 'Parent item menu']);

        $categories = \Corp\Category::select('id', 'title', 'alias', 'parent_id')->get();

        $list = [];
        $list = array_add($list, '0', 'No used');
        $list = array_add($list, 'parent', 'Section Blog');

        foreach ($categories as $category) {
            if($category->parent_id == 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->a_rep->get(['id', 'title', 'alias']);

        $articles = $articles->reduce(function($returnArticles, $article) {

            $returnArticles[$article->alias] = $article->title;

            return $returnArticles;

        }, []);

        $filters = \Corp\Filter::select('id', 'title', 'alias')->get()->reduce(function($returnFilters, $filter) {

            $returnFilters[$filter->alias] = $filter->title;

            return $returnFilters;
        }, ['parent' => 'Section Portfolio']);

        $portfolios = $this->p_rep->get(['id', 'title', 'alias'])->reduce(function($returnPortfolios, $portfolio) {

            $returnPortfolios[$portfolio->alias] = $portfolio->title;

            return $returnPortfolios;
        }, []);

        $this->content = view(env('THEME') . '.admin.menus_edit_content')
                        ->withMenus($menus)
                        ->withMenu($menu)
                        ->withCategories($list)
                        ->withArticles($articles)
                        ->withFilters($filters)
                        ->withPortfolios($portfolios)
                        ->withType($type)
                        ->withOption($option)
                        ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenusRequest $request, \Corp\Menu $menu)
    {
        $result = $this->m_rep->updateMenu($request, $menu);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Corp\Menu $menu)
    {
        $result = $this->m_rep->deleteMenu($menu);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    protected function getMenus() {
        $menus = $this->m_rep->get();

        if($menus->isEmpty()) {
            return FALSE;
        }

        return Menu::make('forMenuPart', function($m) use ($menus) {
            foreach($menus as $item) {
                if($item->parent == 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
    }
}
