<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('is-admin')){
            return view('admin.users.index',['users' => User::paginate(10)]); 
        }
        return view('/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('is-admin')){
            return view('admin.users.create', ['roles' =>Role::all()]); 
        }
        return view('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->sync($request->roles);
       
        return redirect(route('admin.users.index')); 
        
    }

    public function allowed(){
        return Gate::allows('is-admin');
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

        if(Gate::allows('is-admin')){
            return view('admin.users.edit', 
            [
            'roles' =>Role::all(),
            'user' =>User::find($id)
            ]);  
        }
        return view('/dashboard');       
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
        $user = User::findOrfail($id);
        
        //validate post data
        $this->validate($request, [
            'name'  =>'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $request->all();
        $request['name'] = $request['name'];
        $request['email'] = $request['email'];
        $request['password'] = Hash::make($request['password']);


        $postData = [$request['name'] , $request['email'], $request['password']];


        $user->update($request->except(['_token','roles']));
        $user->roles()->sync($request->roles);
 
        return redirect(route('admin.users.index'));
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('is-admin')){
              User::destroy($id);
        return redirect(route('admin.users.index'));
        }
        return view('/dashboard');    
    }
}
