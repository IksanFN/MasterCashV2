<x-master-layout title="Transaction">

    @section('header')
        <h4>Transactions</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12">
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
                                            @if ($transaction->is_paid AND $transaction->payment_status == 'Process')
                                                <span class="badge bg-primary">{{ $transaction->payment_status }}</span>
                                            @elseif ($transaction->is_paid AND $transaction->payment_status == 'Waiting')
                                                <span class="badge bg-secondary">Waiting Confirm</span>
                                            @elseif ($transaction->is_paid AND $transaction->payment_status == 'Cancel')
                                                <span class="badge bg-warning">{{ $transaction->payment_status }}</span>
                                            @elseif ($transaction->is_paid AND $transaction->payment_status == 'Paid')
                                                <span class="badge bg-success">{{ $transaction->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->payment_date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('transactions.invoice', $transaction->uuid) }}" class="btn btn-dark shadow-sm"><i class="bi bi-receipt"></i></a>
                                            {{-- <a href="{{ route('transactions.edit', $bill->uuid) }}" class="btn btn-sm btn-warning text-white shadow-sm"><i class="bi bi-pencil-square"></i></a> --}}
                                            <button type="button" class="btn btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#hapusUser">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="hapusUser" tabindex="-1" aria-labelledby="hapusUserLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="hapusUserLabel">Hapus User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus nya?</p>
                                                        <form action="" method="post">
                                                        @csrf
                                                        @method('PUT')
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
                                <div class="alert alert-warning text-center" role="alert">
                                    <strong>Data belum ada!</strong>
                                </div>
                                @endforelse
                                
                            </tbody>
                        </table>
                        {{-- <x-pagination :items="$transactions"/> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>