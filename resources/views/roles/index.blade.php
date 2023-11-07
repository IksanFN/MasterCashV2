<x-master-layout title="Roles">

    @section('header')
        <h4 class="text-center">Roles</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8 col-sm-12">
            @livewire('roles.role-list')
        </div>
    </div>

</x-master-layout>