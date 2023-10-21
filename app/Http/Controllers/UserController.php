<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string',
            'email' => 'email', 'unique:users',
            'password' => bcrypt($request->password),
        ]);

        User::create($request->all());

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
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'string',
            'email' => 'email|unique:users,email,'.$user->id.',id',
        ]);

        $user->update([
            'name' => $request->name,
            'emial' => $request->email,
            'password' => bcrypt($request->password),
        ]);
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
