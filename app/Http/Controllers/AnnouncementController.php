<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('announcements.index');
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description'  => ['nullable', 'string'],
            'expired' => ['required', 'date'],
        ]);

        $announcement = Announcement::create($request->all());

        Alert::success('Success', 'Announcement Created Successfully');
        return to_route('announcements.index');
    }

    public function show(Announcement $announcement)
    {
        //
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description'  => ['nullable', 'string'],
            'expired' => ['required', 'date'],
        ]);

        $announcement->update($request->all());

        Alert::success('Success', 'Announcement Updated Successfully');
        return to_route('announcements.index');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        Alert::success('Success', 'Announcement Deleted Successfully');
        return back();
    }
}
