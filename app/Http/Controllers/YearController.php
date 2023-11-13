<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class YearController extends Controller
{
    public function index()
    {
        return view('years.index');
    }

    public function create()
    {
        return view('years.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'numeric', 'unique:years'],
        ]);

        Year::create([
            'title' => $request->title,
        ]);

        Alert::success('Success', 'Year Created Successfully');
        return to_route('years.index');
    }

    public function show(Year $year)
    {
        //
    }

    public function edit(Year $year)
    {
        return view('years.edit', compact('year'));
    }

    public function update(Request $request, Year $year)
    {
        $this->validate($request, [
            'title' => ['required', 'numeric', 'unique:years,title,'.$year->id.',id'],
        ]);

        $year->update(['title' => $request->title]);

        Alert::success('Success', 'Year Updated Successfully');
        return to_route('years.index');
    }

    public function destroy(Year $year)
    {
        $year->delete();
        Alert::success('Success', 'Year Deleted Successfully');
        return back();
    }
}
