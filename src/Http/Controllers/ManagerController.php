<?php

namespace Jybtx\Backstaged\Http\Controllers;

use Illuminate\Http\Request;
use Jybtx\Backstaged\Models\Admin;
use Jybtx\Backstaged\Http\Controllers\Controller;
use Jybtx\Backstaged\Services\ManagerService;
use Jybtx\Backstaged\Services\RoleService;
use Jybtx\Backstaged\Requests\AdminRequest;

class ManagerController extends Controller
{
    protected $manager;
    protected $role;
    public function __construct(ManagerService $manager,RoleService $role)
    {
        $this->manager = $manager;
        $this->role    = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->manager->index();
        return view('jybtx::manager.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Admin $manager)
    {
        $roles = $this->role->index();
        return view('jybtx::manager.create',compact('manager','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $manager = $request->all();
        if ( $request->hasFile('avatar') )
        {
            $manager['avatar'] = str_replace('public','/storage',$request->avatar->store('public/manager'));
        }
        $manager['role_id'] = $request->role_id?:'2';
        $manager['password'] = bcrypt( $request->password );
        return $this->manager->store($manager);
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
        $manager = $this->manager->show($id);
        $roles = $this->role->index();
        return view('jybtx::manager.edit',compact('manager','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $manager = $request->except('_method','_token');
        if ( $request->hasFile('avatar') ) {
            @$this->manager->deleteImages($id);
            $manager['avatar'] = str_replace('public','/storage',$request->avatar->store('public/manager'));
        }
        if ( !empty($request->password) ) {
            $manager['password'] = bcrypt( $request->password );
        } else {
            $manager['password'] = $this->manager->show($id)->password;
        }
        return $this->manager->update($manager,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->manager->destroy($id);
    }
}
