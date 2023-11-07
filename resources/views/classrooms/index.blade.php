<x-master-layout>

    @section('header')
        <h4 class="text-center">Classrooms</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8 col-sm-12">
            @livewire('classrooms.classroom-list')
        </div>
    </div>

</x-master-layout>