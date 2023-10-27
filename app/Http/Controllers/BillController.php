<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Year;
use App\Models\Month;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Bills\BillStore;
use App\Models\Classroom;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class BillController extends Controller
{
    public function index()
    {
        $bills = Transaction::query()->with('user')->where('is_paid', false)->where('payment_status', 'Unpaid')->latest()->paginate();
        return view('bills.index', compact('bills'));
    }

    public function createByClassroom()
    {
        $years = Year::all();
        $months = Month::all();
        $weeks = Week::all();
        $classrooms = Classroom::all();
        return view('bills.create-by-class', compact('years', 'months', 'weeks', 'classrooms'));
    }

    public function storeByClassroom(BillStore $request)
    {
        $students = User::query()->with('classroom')->whereClassroomId($request->classroom)->get();
        
        // Check data students
        if (!$students) {
            Alert::warning('Information', 'Students doesn\'t exist');
            return back();
        }

        // Get data year, month, and week
        $year = Year::find($request->year);
        $month = Month::find($request->month);
        $week = Week::find($request->week);

        // Loop students
        foreach ($students as $student) {
            
            // Generate Bill Code
            $getNisn = substr($student->nisn, -3);
            $billCode = "{$getNisn}/".str_replace(' ', '', $student->classroom->title)."/{$week->id}/{$month->id}/{$year->title}";

            // Check bill
            if (Transaction::query()->whereBillCode($billCode)->exists()) {
                Alert::error('Failed', 'Bill already exist!');
                return to_route('bills.index');
            }

            // Create bill
            $bill = new Transaction();
            $bill->uuid = Str::uuid();
            $bill->user_id = $student->id;
            $bill->year_id = $year->id;
            $bill->month_id = $month->id;
            $bill->week_id = $week->id;
            $bill->bill_code = $billCode;
            $bill->bill = $request->bill;
            $bill->payment_status = 'Unpaid';
            $bill->save();

            // Check Query 
            if ($bill) {
                Alert::success('Success', 'Create bill successfully!');
            } else {
                Alert::error('Error', 'Something went wrong!');
            }
        }
        return to_route('bills.index');
    }
}
