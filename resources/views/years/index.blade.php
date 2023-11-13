<x-master-layout title="Years">

    @section('header')
        <h4 class="text-center">Years</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6">
            @livewire('years.year-list')
        </div>
    </div>

</x-master-layout>