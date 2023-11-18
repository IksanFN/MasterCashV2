<x-master-layout title="Edit Expense">

    @section('header')
        <h4 class="text-center">Edit Expense</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <form action="{{ route('expenses.update', $expense->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" >
                            @error('image')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $expense->title }}">
                            @error('title')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" value="{{ $expense->amount }}">
                            @error('amount')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Date</label>
                            <input type="date" class="form-control" name="expense_date" value="{{ $expense->expense_date }}">
                            @error('expense_date')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ $expense->description }}</textarea>
                            @error('description')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>