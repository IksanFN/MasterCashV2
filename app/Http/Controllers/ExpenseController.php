<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Nette\Schema\Expect;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('expenses.index');
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('expenses.create', compact('classrooms'));
    }

    public function detail(Expense $expense)
    {
        
        return view('expenses.detail', compact('expense'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'title' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
            'for_classroom' => ['required', 'not_in:default'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('/public/expense', $image->hashName());

            $expense = Expense::create([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
                'amount' => $request->amount,
                'expense_date' => $request->expense_date,
                'user_created' => Auth::user()->name,
            ]);
        } else {
            $expense = Expense::create([
                'title' => $request->title,
                'description' => $request->description,
                'amount' => $request->amount,
                'expense_date' => $request->expense_date,
                'user_created' => Auth::user()->name,
            ]);
        }

        ($expense) ? Alert::success('Success', 'Expense Created Successfully') : Alert::error('Error', 'Something went wrong! Please try again later') ;

        return to_route('expenses.index');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        // Check Image
        if ($request->hasFile('image')) {
            // Get new image
            $image = $request->file('image');
            $image->storeAs('/public/expense', $image->hashName());

            // Delete Old Image
            Storage::delete('/public/expense/' . $expense->image);
            
            $expense->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
                'amount' => $request->amount,
                'expense_date' => $request->expense_date,
                'user_created' => Auth::user()->name,
            ]);
        } else {
            $expense->update([
                'title' => $request->title,
                'description' => $request->description,
                'amount' => $request->amount,
                'expense_date' => $request->expense_date,
                'user_created' => Auth::user()->name,
            ]);
        }

        Alert::success('Success', 'Expense Updated Successfully');
        return to_route('expenses.index');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        Alert::success('Success', 'Expense Deleted Successfully');
        return back();
    }
}
