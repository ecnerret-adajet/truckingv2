<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Role;
use DB;
use Image;
use Hash;
use App\Company;
use App\Department;
use App\Permission;
use Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('created_at','DESC')->get();
        $roles = Role::all();
        $permission = Permission::get();
        return view('users.index',compact(
            'roles',
            'permission',
            'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        $companies = Company::pluck('name','id');
        $departments = Department::pluck('name','id');     
        return view('users.create',compact(
            'companies',
            'departments',
            'roles'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles_list' => 'required',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->position = $request->input('position');
        $user->password = Hash::make($request->input('password'));
        if($request->hasFile('avatar')){
        $user->avatar = $request->file('avatar')->store('users');
        }
        $user->save();

        $user->companies()->attach($request->input('company_id'));
        $user->departments()->attach($request->input('department_id'));
         $user->roles()->sync( (array) $request->input('roles_list') );

          alert()->success('Success Message', 'Create account successful');

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('display_name','id');
        $companies = Company::pluck('name','id');
        $departments = Department::pluck('name','id'); 
        $roles = Role::pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();

        return view('users.edit',compact('user','roles','userRole','departments','companies'));
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
        $this->validate($request, [
            'company_list' => 'required',
            'department_list' => 'required',
            'roles_list' => 'required',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user->update($input);
        $user->companies()->sync( (array) $request->input('company_list') );
        $user->departments()->sync( (array) $request->input('department_list') );
        $user->roles()->sync( (array) $request->input('roles_list') );

        alert()->success('Success Message', 'Update Succesfully');

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
