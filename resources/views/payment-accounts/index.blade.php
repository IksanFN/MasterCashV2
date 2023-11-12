<x-master-layout title="Payment Accounts">

    @section('header')
        <h4>Payment Accounts</h4>
    @endsection

    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-12">
            @livewire('payment-accounts.payment-account-list')
        </div>
    </div>

</x-master-layout>