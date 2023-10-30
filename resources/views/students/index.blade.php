<x-master-layout title="Students">

    @section('header')
        <h4>Students</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12 col-sm-12">
            @livewire('students.student-list')
        </div>
    </div>

</x-master-layout>