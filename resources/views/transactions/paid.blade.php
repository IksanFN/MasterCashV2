<x-master-layout title="Transaction Paid">

    @section('header')
        <h4>Transactions Paid</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12">
            @livewire('transactions.transaction-paid-list')
        </div>
    </div>

</x-master-layout>