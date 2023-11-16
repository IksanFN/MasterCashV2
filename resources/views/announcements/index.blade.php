<x-master-layout title="Announcements">

    @section('header')
        <h4>Announcements</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12">
            @livewire('announcement.announcement-list')
        </div>
    </div>

</x-master-layout>