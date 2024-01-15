<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;

use Config;

class PortfoliosController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep){
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->p_rep = $p_rep;
        
        $this->template = env('THEME') . '.portfolios';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->keywords = 'Portfolios';
        $this->meta_desc = 'Portfolios';
        $this->title = 'Portfolios';
        
        // PORTFOLIO
        $portfolios = $this->getPortfolios();

        $content = view(env('THEME') . '.portfolios_content')
                        ->with('portfolios', $portfolios)
                        ->render();

        $this->vars = array_add($this->vars, 'content', $content);


        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias) {
        
        $portfolio = $this->p_rep->one($alias);

        $this->title = $portfolio->title;
        $this->keywords = $portfolio->keywords;
        $this->meta_desc = $portfolio->meta_desc;

        $portfolios = $this->getPortfolios(config('settings.other_portfolios'), FALSE);


        $content = view(env('THEME') . '.portfolio_content')
                                ->withPortfolio($portfolio)
                                ->withPortfolios($portfolios)
                                ->render();

        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput(); 
    }

    protected function getPortfolios($take = FALSE, $paginate = TRUE){
        $portfolios = $this->p_rep->get('*', $take, $paginate);

        if($portfolios){
            $portfolios->load('filter');
        }

        return $portfolios;
    }
}
