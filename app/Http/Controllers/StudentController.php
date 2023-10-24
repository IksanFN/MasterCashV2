<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Major;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Students\StudentStore;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::query()->whereNot('is_student', false)->latest()->paginate();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $majors = Major::all();
        return view('students.create', compact('classrooms', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStore $request)
    {
        if ($request->hasFile('avatar')) {

            // Get Name File and Move Image
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatar', $avatar->hashName());

            // Create
            $student = User::create([
                'avatar' => $avatar->hashName(),
                'classroom_id' => $request->classroom,
                'major_id' => $request->major,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
                'is_student' => true,
                'is_verified' => true,
            ]);

            $student->assignRole($request->roles);
        } else {
            $student = User::create([
                'classroom_id' => $request->classroom,
                'major_id' => $request->major,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
                'is_student' => true,
                'is_verified' => true,
            ]);
            $student->assignRole($request->roles);
        }
    
        Alert::success('Success', 'Student Created Successfully');
        return to_route('students.index');
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
    public function edit($uuid)
    {
        $student = User::query()->whereUuid($uuid)->first();
        $classrooms = Classroom::all();
        $majors = Major::all();
        return view('students.edit', compact('student', 'classrooms', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $student = User::query()->whereUuid($uuid)->first();
        if ($request->hasFile('avatar')) {

            // Get name file
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatar', $avatar->hashName());

            // Delete old avatar
            Storage::delete('storage/avatar/'.$student->avatar);
            
            $student->update([
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
            $student->assignRole($request->roles);
        } else {
            $student->update([
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
            $student->assignRole($request->roles);
        }
        Alert::success('Success', 'Student Updated Successfully');
        return to_route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $student = User::query()->whereUuid($uuid)->first();
        $student->delete();
        Alert::success('Deleted', 'Student Deleted Successfully');
        return back();
    }
}
