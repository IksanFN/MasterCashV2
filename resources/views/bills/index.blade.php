<x-master-layout title="Bills">

    @section('header')
        <h4>Bills</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12 col-sm-12">
            <div>
                <div class="card border-0 p-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" wire:model.live.debounce.1000ms='query' placeholder="Search" class="form-control">
                            </div>
                            {{-- <div class="col-md-2">
                                <select wire:model.live='classroom' id="" class="form-select">
                                    <option value="" selected>All Class</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->title }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-2 ms-auto text-end">
                                <a href="{{ route('bills.create_by_classroom') }}" class="btn btn-dark shadow-sm" ><i class="bi bi-person-plus-fill"></i></a>
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
                                                <a href="{{ route('checkouts.checkout', $bill->uuid) }}" class="btn btn-dark shadow-sm"><i class="bi bi-credit-card me-1"></i> Checkout</a>
                                                {{-- <a href="{{ route('bills.edit', $bill->uuid) }}" class="btn btn-sm btn-warning text-white shadow-sm"><i class="bi bi-pencil-square"></i></a> --}}
                                                {{-- <button type="button" class="btn btn-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#hapusUser">
                                                    <i class="bi bi-trash3-fill"></i>
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
                                                            <form action="{{ route('checkouts.checkout_payment_gateway', $bill->id) }}" method="post">
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
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @empty
                                    <div class="alert alert-warning text-center" role="alert">
                                        <strong>Data belum ada!</strong>
                                    </div>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                            {{-- <x-pagination :items="$bills"/> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>