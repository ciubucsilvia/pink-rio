<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;
use Gate;

class PermissionsController extends AdminController
{
    protected $per_rep; // permissions_repository
    protected $rol_rep; // roles_repository

    public function __construct(PermissionsRepository $per_rep, RolesRepository $rol_rep) {
        
        parent::__construct();

        $this->middleware(function($request, $next) {
            if(Gate::denies('EDIT_USERS')) {
                abort(403, 'Unauthorized action.');
            }
           
            return $next($request);
        }); 

        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;

        $this->template = env('THEME') . '.admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Manager roles and permissions';

        $roles = $this->getRoles();

        $permissions = $this->getPermissions();



        // $articles = $this->getArticles();

        $this->content = view(env('THEME') . '.admin.permissions_content')
                                ->with(['roles' => $roles, 'privs' => $permissions])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $result = $this->per_rep->changePermissions($request);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return back()->with($result);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getRoles() {
        $roles = $this->rol_rep->get();
        
        return $roles;
    }

    protected function getPermissions() {
        $permissions = $this->per_rep->get();
        
        return $permissions;
    }
}
