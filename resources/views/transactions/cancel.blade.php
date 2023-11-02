<x-master-layout title="Transaction Cancel">

    @section('header')
        <h4>Transactions Cancel</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12">
            @livewire('transactions.transaction-cancel-list')
        </div>
    </div>

</x-master-layout>