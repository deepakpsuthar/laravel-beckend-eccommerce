<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        abort_if(!auth()->user()->can('view role'),403);
        $roles =  Role::whereNot('name','superadmin')->get();
        return view('admin.roles.index',compact('roles'));

    }

    public function create()
    {
        abort_if(!auth()->user()->can('add role'),403);
        $permissions  =  $this->fetchAllPermissionsWithMap();
        return view('admin.roles.create',compact('permissions'));

    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add role'),403);

       $request->validate([
        'name' => 'required|unique:roles,name'
       ]);

       $role = Role::create(['name' => $request->get('name')]);
       $permissions = $request->get('permissions');
       $role->syncPermissions($permissions);
       return redirect()->route('admin.roles.index')->with('success','roles and permission created successfully');

    }

    public function show(Role $role)
    {
        abort_if(!auth()->user()->can('view role'),403);

    }

    public function fetchAllPermissionsWithMap(){
        $return =  [];
        $permissions = Permission::all();
        foreach($permissions as $permission){
            if(!isset($return[$permission->module])){
                $return[$permission->module] =[];
            }
            $return[$permission->module][] = $permission;
        }
        return (Object) $return;
    }
    public function edit(Role $role)
    {
        abort_if(!auth()->user()->can('edit role'),403);

        $permissions  =  $this->fetchAllPermissionsWithMap();
        $userPermissions= $role->permissions()->pluck('name')->toArray();
       return view('admin.roles.edit',compact('role','permissions','userPermissions'));
    }


    public function update(Request $request, Role $role)
    {
        abort_if(!auth()->user()->can('edit role'),403);

        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id
           ]);

        $role->name =  $request->get('name');
        $role->save();

        $permissions = $request->get('permissions');
        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index')->with('success','roles & permission updated successfully');
    }


    public function destroy(Role $role)
    {
        abort_if(!auth()->user()->can('delete role'),403);

        $role->delete();
    }
}
