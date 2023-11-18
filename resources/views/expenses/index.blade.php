<x-master-layout title="Expenses">

    @section('header')
        <h4>Expenses</h4>
    @endsection

    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    @livewire('expenses.expense-list')
                </div>
            </div>
        </div>
    </div>

</x-master-layout>