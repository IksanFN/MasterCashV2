<x-master-layout title="Create Announcement">

    @section('header')
        <h4 class="text-center">Create Announcement</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card shadow-smooth border-0 p-2">
                <div class="card-body">
                    <form action="{{ route('announcements.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"/>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expired</label>
                            <input type="date" name="expired" class="form-control"/>
                            @error('expired')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-dark px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>