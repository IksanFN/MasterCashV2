<x-master-layout title="Bills">

    @section('header')
        <h4>Bills</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12 col-sm-12">
            @livewire('bills.bill-list')
        </div>
    </div>

</x-master-layout>