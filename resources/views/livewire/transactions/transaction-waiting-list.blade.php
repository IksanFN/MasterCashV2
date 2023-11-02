<div>
    <div class="card border-0 p-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" wire:model.live.debounce.500ms='query' placeholder="Search" class="form-control">
                </div>
                <div class="col-md-2">
                    <select wire:model.live='classroom' class="form-select">
                        <option value="" selected>All Class</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model.live='limit' id="" class="form-select">
                        <option value="5">5 Data</option>
                        <option value="10">10 Data</option>
                        <option value="25">25 Data</option>
                        <option value="50">50 Data</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-smooth p-3">
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table mb-3">
                    <thead>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Amount</th>
                        <th>Bill</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th class="text-center">Aksi</th>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($transactions as $transaction)
                            <tr wire:key='{{ $transaction->id }}'>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $loop->index + $transactions->firstItem() }}</td> --}}
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->user->classroom->title }}</td>
                                <td>{{ number_format($transaction->bill) }}</td>
                                <td>{{ $transaction->week->title }}, {{ $transaction->month->title }} {{ $transaction->year->title }}</td>
                                <td>
                                    <span class="badge bg-warning">{{ $transaction->payment_status }}</span>
                                </td>
                                <td>{{ $transaction->payment_date }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#confirmTransaction">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmTransaction" tabindex="-1" aria-labelledby="confirmTransactionLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="confirmTransactionLabel">Confirm Transaction</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you will confirm this transaction??</p>
                                                <form action="{{ route('transactions.store_confirm', $transaction->uuid) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Confirm Transaction</button>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    {{-- <a href="{{ route('transactions.store_confirm', $transaction->uuid) }}" class="btn btn-dark shadow-sm"><i class="bi bi-receipt"></i></a> --}}
                                    {{-- <a href="{{ route('transactions.edit', $bill->uuid) }}" class="btn btn-sm btn-warning text-white shadow-sm"><i class="bi bi-pencil-square"></i></a> --}}
                                    <button type="button" class="btn btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#cancelTransaction">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelTransaction" tabindex="-1" aria-labelledby="cancelTransactionLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="cancelTransactionLabel">Cancel Transaction</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you will cancel this transaction??</p>
                                                <form action="{{ route('transactions.store_cancel', $transaction->uuid) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Cancel Transaction</button>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <div class="alert alert-warning text-center" role="alert">
                            <strong>Data belum ada!</strong>
                        </div>
                        @endforelse
                        
                    </tbody>
                </table>
                <x-pagination :items="$transactions"/>
            </div>

        </div>
    </div>
</div>