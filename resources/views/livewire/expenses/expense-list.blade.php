<div>
    <div class="row mb-5 align-items-center gap-2">
        <div class="col-md-3">
            <input type="text" wire:model.live.debounce.500ms='query' placeholder="Search" class="form-control">
        </div>
        <div class="col-md-2">
            <input type="date" wire:model='startDate' placeholder="Search" class="form-control">
        </div>
        -
        <div class="col-md-2">
            <input type="date" wire:model.live='endDate' placeholder="Search" class="form-control">
        </div>
        <div class="col-md-2 ms-auto text-end">
            <a wire:navigate href="{{ route('expenses.create') }}" class="btn btn-dark shadow-sm" ><i class="bi bi-plus-circle"></i></a>
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
                <th>Title</th>
                <th>Amount</th>
                <th>Expense Date</th>
                <th>Image</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody class="align-middle">
                @forelse ($expenses as $expense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $expense->title }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->expense_date }}</td>
                        <td>
                            @if ($expense->image)
                                Available
                            @else
                                Nothing Image
                            @endif
                        </td>
                        <td class="text-center">
                            <a wire:navigate href="{{ route('expenses.detail', $expense->id) }}" class="btn btn-dark shadow-sm"><i class="bi bi-eye-fill"></i></a>
                            <a wire:navigate href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-dark"><i class="bi bi-pencil-square"></i></a>
                            <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteExpense">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteExpense" tabindex="-1" aria-labelledby="deleteExpenseLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteExpenseLabel">Delete Expense</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete it?</p>
                                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="post">
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
        <x-pagination :items="$expenses" />
    </div>
</div>