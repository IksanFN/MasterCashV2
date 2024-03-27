<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Major;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\UserStore;
use App\Http\Requests\Users\UserUpdate;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('is_student', false)->latest()->paginate();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        $majors = Major::all();
        $roles = Role::get('name');
        return view('users.create', compact('classrooms', 'majors', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStore $request)
    {
        return $request->all();
        if ($request->hasFile('avatar')) {

            // Get Name File and Move Image
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatar', $avatar->hashName());

            // Create
            $user = User::create([
                'avatar' => $avatar->hashName(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'is_student' => 0,
                'for_classroom' => $request->classroom,
            ]);
            $user->assignRole($request->roles);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'is_student' => 0,
                'for_classroom' => $request->classroom,
            ]);
            $user->assignRole($request->roles);
        }
    
        Alert::success('Success', 'User Created Successfully');
        return to_route('users.index');
    }

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userRole = $user->roles->first();
        $roles = Role::all();
        return view('users.edit', compact('user', 'userRole', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdate $request, User $user)
    {
        if ($request->hasFile('avatar')) {

            // Get name file
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatar', $avatar->hashName());

            // Delete old avatar
            Storage::delete('storage/avatar/'.$user->avatar);
            
            $user->update([
                'avatar' => $avatar->hashName(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_student' => false,
            ]);
            
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->roles);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_student' => false,
            ]);
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->roles);
        }
        Alert::success('Success', 'Updated Successfully');
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::Success('Deleted', 'User Deleted Successfully');
        return back();
    }
}
