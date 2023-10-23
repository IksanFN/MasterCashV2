<x-master-layout title="Edit Permission">

    @section('header')
        <h4 class="text-center">Edit Permission</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Name Permission</label>
                            <input type="text" name="name" class="form-control" placeholder="Permission" value="{{ $permission->name }}">
                            @error('name')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4 shadow-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>