<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserStore;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->latest()->paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $majors = Major::all();
        return view('users.create', compact('classrooms', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStore $request)
    {
        // return $request->all();
        if ($request->hasFile('avatar')) {

            // Get Name File and Move Image
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatar', $avatar->hashName());

            // Create
            $user = User::create([
                'avatar' => $avatar->hashName(),
                'classroom_id' => $request->classroom,
                'major_id' => $request->major,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
        } else {
            $user = User::create([
                'classroom_id' => $request->classroom,
                'major_id' => $request->major,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
        }
    
        Alert::success('Success', 'User Created Successfully');
        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $classrooms = Classroom::all();
        $majors = Major::all();
        return view('users.edit', compact('user', 'classrooms', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($request->hasFile('avatar')) {

            // Get name file
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatar', $avatar->hashName());

            // Delete old avatar
            Storage::delete('storage/avatar/'.$user->avatar);
            
            $user->update([
                'avatar' => $avatar->hashName(),
                'classroom_id' => $request->classroom,
                'major_id' => $request->major,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);

        } else {
            $user->update([
                'classroom_id' => $request->classroom,
                'major_id' => $request->major,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
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
