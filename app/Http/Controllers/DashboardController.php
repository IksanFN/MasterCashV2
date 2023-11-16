<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $now = Carbon::today()->toDateString();
        $announcement = Announcement::query()->latest()->first();
        return view('dashboard', compact('announcement', 'now'));
    }
}
