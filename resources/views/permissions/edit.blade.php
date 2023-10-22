<x-master-layout title="Edit Permissions">

    @section('header')
        <h4 class="text-center">Edit Permissions</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">

                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $permission->name }}">
                            @error('name')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4 shadow-smooth">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>