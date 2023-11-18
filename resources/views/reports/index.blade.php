<x-master-layout title="Reports">

    @section('header')
        <h4 class="text-center">Reports Transaction</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-10">
            @livewire('reports.report-list')
        </div>
    </div>

</x-master-layout>