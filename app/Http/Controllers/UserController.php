<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware; /// by me
use Illuminate\Routing\Controllers\Middleware; /// by me
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    ///// This function is used by me
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view users', only:['index']),
            new Middleware('permission:edit users', only:['edit']),
            new Middleware('permission:create users', only:['create']),
            new Middleware('permission:delete roles', only:['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.list',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name','ASC')->get();
        return view('users.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        if($validator->fails()) {
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        //// Assigning the role to the user
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success','User added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::orderBy('name','ASC')->get();

        $hasRoles = $user->roles->pluck('id');

        return view('users.edit',[
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,'.$id.',id'
        ]);

        if($validator->fails()) {
            return redirect()->route('users.edit',$id)->withInput()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        //// Assigning the role to the user
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success','User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);

        if($user == null) {
            session()->flash('error','User not found');
            return response()->json([
                'status' => false
            ]);
        }
        $user->delete();

        session()->flash('success','User deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
