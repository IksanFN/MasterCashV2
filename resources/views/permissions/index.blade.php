<x-master-layout title="Permissions">

    @section('header')
        <h4 class="text-center">Permissions</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8 col-sm-12">
            @livewire('permissions.permission-list')
        </div>
    </div>

</x-master-layout>