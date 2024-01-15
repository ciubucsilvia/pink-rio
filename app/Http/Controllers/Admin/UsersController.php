<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\UsersRepository;
use Corp\Repositories\RolesRepository;
use Gate;
use Corp\User;

class UsersController extends AdminController
{
    protected $u_rep;   // users_repository
    protected $rol_rep; // roles_repository

    public function __construct(UsersRepository $u_rep, RolesRepository $rol_rep) {
        parent::__construct();

        $this->middleware(function($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')) {
                abort(403, 'Unauthorized action.');
            }
           
            return $next($request);
        }); 

        $this->u_rep = $u_rep;
        $this->rol_rep = $rol_rep;

        $this->template = env('THEME') . '.admin.users';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Manager users';

        $users = $this->getUsers();

        $this->content = view(env('THEME') . '.admin.users_content')
                                ->with('users', $users)
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
        // if(Gate::denies('save', new Users)){
        //     abort(403, 'Unauthorized action.');
        // }

        $this->title = 'Add new user';

        $roles = $this->rol_rep->get();

         $lists = array();

        foreach($roles as $role){
            $lists[$role->id] = $role->name;
        }

        $this->content = view(env('THEME') . '.admin.users_create_content')
                        ->with('roles', $lists)
                        ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $result = $this->u_rep->addUser($request);

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
    public function edit(User $user)
    {
         // if(Gate::denies('save', new Users)){
        //     abort(403, 'Unauthorized action.');
        // }

        $this->title = 'Edit user';

        $roles = $this->rol_rep->get()->reduce(function($returnRoles, $role){

            $returnRoles[$role->id] = $role->name;

            return $returnRoles;
        });

        $this->content = view(env('THEME') . '.admin.users_edit_content')
                        ->with('roles', $roles)
                        ->withUser($user)
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
    public function update(Request $request, User $user)
    {
        $result = $this->u_rep->updateUser($request, $user);

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
    public function destroy(User $user)
    {
        $result = $this->a_rep->deleteUser($user);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    public function getUsers() {
        return $this->u_rep->get();
    }
}
