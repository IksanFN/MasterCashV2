<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:classroom-list|classroom-create|classroom-edit|classroom-delete', ['only' => ['index','show']]);
        $this->middleware('permission:classroom-create', ['only' => ['create','store']]);
        $this->middleware('permission:classroom-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:classroom-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::query()->latest()->paginate();
        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'unique:classooms'],
        ]);

        $classroom = Classroom::create($request->all());

        Alert::success('Success', 'Classroom Created Successfully');
        return to_route('classrooms.index');
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
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('classrooms', 'id')->ignore($classroom->id, 'id')],
        ]);

        $classroom->update($request->all());

        Alert::success('Success', 'Classroom Updated Successfully');
        return to_route('classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        Alert::success('Success', 'Classroom Deleted Successfully');
        return back();
    }
}
