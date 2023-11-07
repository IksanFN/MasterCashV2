<x-master-layout>

    @section('header')
        <h4>Users</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12 col-sm-12">
            @livewire('users.user-list')
        </div>
    </div>

</x-master-layout>