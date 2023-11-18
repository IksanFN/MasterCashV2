<x-master-layout title="Detail Expense">

    @section('header')
        <h4 class="text-center">Detail Expense</h4>
    @endsection

    <div class="row justify-content-center">
       <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <img src="{{ asset('storage/expense/'.$expense->image) }}" alt="" class="img-fluid rounded d-block mb-3">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="fw-bold">Title</span> : {{ $expense->title }}</li>
                        <li class="list-group-item"><span class="fw-bold">Amount</span> : {{ $expense->amount }}</li>
                        <li class="list-group-item"><span class="fw-bold">Expense Date</span> : {{ $expense->expense_date }}</li>
                        <li class="list-group-item"><span class="fw-bold">Description</span> : {{ $expense->description }}</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>