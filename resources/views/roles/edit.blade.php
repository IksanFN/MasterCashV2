<x-master-layout title="Edit Roles">

    @section('header')
        <h4 class="text-center">Edit Roles</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">

                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                            @error('name')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Permissions</label>
                            @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach                              
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4 shadow-smooth">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">
                    <p>Permission Has Role</p>
                    <div class="mb-3">
                            @forelse ($rolePermissions as $permission)
                                <form method="post" action="{{ route('roles.permission_destroy', [$role->id, $permission->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-secondary m-1">{{ $permission->name }}</button>
                                </form>
                            @empty
                                tes
                            @endforelse
                        </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>