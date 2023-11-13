<div class="card border-0 shadow-smooth p-2">
    <div class="card-body">

        <div class="row mb-5">
            <div class="col-md-4">
                <input type="text" wire:model.live.debounce.500ms='query' placeholder="Search" class="form-control">
            </div>
            <div class="col-md-2 ms-auto text-end">
                <a href="{{ route('years.create') }}" class="btn btn-dark shadow-sm" ><i class="bi bi-plus-circle"></i></a>
            </div>
            <div class="col-md-3">
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
                    <th>Nama</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody class="align-middle">
                    @forelse ($years as $year)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$year->title}}</td>
                            <td class="text-center">
                                <a href="{{ route('years.edit', $year->id) }}" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#hapusyear">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="hapusyear" tabindex="-1" aria-labelledby="hapusyearLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="hapusyearLabel">Hapus year</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus nya?</p>
                                            <form action="{{ route('years.destroy', $year->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Hapus</button>
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
            <x-pagination :items="$years" />
        </div>

    </div>
</div>