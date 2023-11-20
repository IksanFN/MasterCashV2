<div>
    <div class="card shadow-smooth border-0 p-2">
        <div class="card-body">
      
            <div class="row mb-5">
                <div class="col-md-3">
                    <input type="text" wire:model.live.debounce.500ms='query' placeholder="Search" class="form-control">
                </div>
                <div class="col-md-2 ms-auto text-end">
                    <a wire:navigate href="{{ route('users.create') }}" class="btn btn-dark shadow-sm" ><i class="bi bi-person-plus-fill"></i></a>
                    <a href="" wire:click.prevent='export' class="btn btn-success shadow-sm"><i class="bi bi-file-earmark-fill me-1"></i></a>
                </div>
                <div class="col-md-2">
                    <select wire:model.live='limit' class="form-select">
                        <option value="5">5 Data</option>
                        <option value="10">10 Data</option>
                        <option value="25">25 Data</option>
                        <option value="50">50 Data</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Non Active</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a wire:navigate href="{{ route('users.edit', $user->uuid) }}" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
                                    <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteUserLabel">Delete User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete it??</p>
                                                <form action="{{ route('users.destroy', $user->uuid) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                Data belum ada
                            </div>                                    
                        @endforelse
                    </tbody>
                </table>
                <x-pagination :items="$users" />
            </div>

        </div>
    </div>
</div>