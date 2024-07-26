<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('view user'),403);

        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('add user'),403);

        $roles = Role::all()->where('name','!=','superadmin')->select('id','name');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add user'),403);

        $request->validate([
            'name'=> 'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role'=>'required'
        ]);

        $user = new User;
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->get('email');
        $user->name =$request->get('name');

        if($request->hasfile('profile_img'))
        {
            $user->image = uploadFile($request,'profile_img','profile');
        }

        if($user->save()){
            $user->assignRole($request->get('role'));
            return redirect()->route('admin.users.index')->with('success','user created successfully');
        }
        return redirect()->back()->with('error','there is some issue with this user please try again');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!auth()->user()->can('view user'),403);

        return view('admin.users.view');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('edit user'),403);

        $user->role =   $user->roles->first()->name;
        $roles = Role::all()->where('name','!=','superadmin')->select('id','name');
        return view('admin.users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_if(!auth()->user()->can('edit user'),403);

        $request->validate([
            'name'=> 'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'role'=>'required'
        ]);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');

        if($request->hasfile('profile_img'))
        {
            $user->image = uploadFile($request,'profile_img','profile');

            if($user->image && $request->has('old_profile') && !empty($request->get('old_profile'))){
                if(file_exists($request->get('old_profile'))){
                    unlink($request->get('old_profile'));
                }
            }
        }

        if($user->save()){
            if(auth()->user()->id != $user->id ){
                $user->syncRoles($request->get('role'));
            }
            return redirect()->route('admin.users.index')->with('success','user updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(!auth()->user()->can('delete user'),403);

        $user->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'user deleted successfully'
        ], 200);
        // return redirect()->route('admin.users.index')->with('success','user deleted successfully');
    }
    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->ids;
            if(!empty($ids)){
                User::whereIn('id', $request->ids)->delete();
                return  response()->json([
                    'status' => 'true',
                    'message' => 'users deleted successfully'
                ], 200);
            }else{
                return  response()->json([
                    'status' => 'false',
                    'message' => 'at list one raw selected required'
                ], 200);
            }
        } catch (Exception $e) {
            return   response()->json([
                'status' => 'false',
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
