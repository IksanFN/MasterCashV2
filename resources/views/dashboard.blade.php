<x-master-layout title="Dashboard">

    @section('header')
        <h4>Dashboard</h4>
    @endsection

    {{-- Announcement --}}
    @if ($now <= $announcement && Auth::user()->is_student == true)
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong class="d-block">{{ $announcement->title }}</strong> 
            <span class="pb-0">{{ $announcement->description }}</span>
        </div>  
    @endif
    
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            
        </div>
    </div>

</x-master-layout>