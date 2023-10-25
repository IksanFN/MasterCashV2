<x-master-layout title="Users">

    @section('header')
        <h4 class="text-center">Edit Users</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card border-0 shadow-smooth p-2 bg-white">
                <div class="card-body">

                    <form action="{{ route('users.update', $user->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                            @error('avatar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Role</label>
                            <select class="form-select" aria-label="Default select example" name="roles">
                                <option value="default" hidden>Choose Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ ($userRole->name == $role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-secondary px-4">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>