<x-master-layout title="Create Year">

    @section('header')
        <h4 class="text-center">Create Year</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    
                    <form action="{{ route('years.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-dark px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>