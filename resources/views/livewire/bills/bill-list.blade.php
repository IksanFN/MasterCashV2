<div>
    <div class="card border-0 p-2">
        <div class="card-body">
            <div class="row gap-2">
                <div class="col-md-3">
                    <input type="text" wire:model.live.debounce.1000ms='query' placeholder="Search" class="form-control">
                </div>
                <div class="col-md-2">
                    <select wire:model.live='classroom' class="form-select">
                        <option value="" selected>All Class</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 ms-auto text-end">
                    <a href="{{ route('bills.create_by_classroom') }}" class="btn btn-dark shadow-sm" ><i class="bi bi-plus-circle"></i></a>
                    <a href="" wire:click.prevent='export' class="btn btn-dark shadow-sm"><i class="bi bi-file-earmark-fill me-1"></i></a>
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

    <div class="card border-0 shadow-smooth">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table mb-3">
                    <thead>
                        <th>No</th>
                        <th>Bill Code</th>
                        <th>NISN</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Amount</th>
                        <th>Bill</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($bills as $bill)
                            <tr wire:key='{{ $bill->id }}'>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $loop->index + $bills->firstItem() }}</td> --}}
                                <td>{{ $bill->bill_code }}</td>
                                <td>{{ $bill->user->nisn }}</td>
                                <td>{{ $bill->user->name }}</td>
                                <td>{{ $bill->user->classroom->title }}</td>
                                <td>{{ number_format($bill->bill) }}</td>
                                <td>{{ $bill->week->title }}, {{ $bill->month->title }} {{ $bill->year->title }}</td>
                                <td>
                                    @if ($bill->is_paid)
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-danger">Unpaid</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#Payment">
                                        <i class="bi bi-credit-card"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="Payment" tabindex="-1" aria-labelledby="PaymentLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="PaymentLabel">Payment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Please choose one method</p>
                                                <a href="{{ route('checkouts_cash.index', $bill->uuid) }}" class="btn btn-primary shadow-smooth">Checkout Cash</a>
                                                <a href="{{ route('transactions.payment_transfer.checkout', $bill->uuid) }}" class="btn btn-secondary shadow-smooth">Checkout Transfer</a>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Tutup</button>
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
                <x-pagination :items="$bills"/>
            </div>
        </div>
    </div>
</div>