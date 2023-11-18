<x-master-layout title="Dashboard">

    @section('header')
        <h4>Dashboard</h4>
    @endsection

    {{-- Announcement --}}
    @if ($now <= $announcement && Auth::user()->is_student == true)
        <div class="alert alert-secondary alert-dismissible fade show border-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong class="d-block">{{ $announcement->title }}</strong> 
            <span class="pb-0">{{ $announcement->description }}</span>
        </div>  
    @endif
    
    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <i class="bi bi-graph-down-arrow fs-2 text-success ms-3"></i>
                        </div>
                        <div class="col-6">
                            <h6>Total Income</h6>
                            <span>{{ number_format($totalIncome - $totalExpense) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <i class="bi bi-graph-up-arrow fs-2 text-danger ms-3"></i>
                        </div>
                        <div class="col-6">
                            <h6>Total Expense</h6>
                            <span>{{ number_format($totalExpense) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <i class="bi bi-people fs-2 text-secondary ms-3"></i>
                        </div>
                        <div class="col-6">
                            <h6>Total Student</h6>
                            <span>{{ $student }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <i class="bi bi-receipt ms-1 fs-2 text-primary"></i>
                        </div>
                        <div class="col-7">
                            <h6>Total Transaction</h6>
                            <span>{{ $totalTransaction }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card border-0 p-2">
                <div class="card-body">
                    <h5 class="mb-4">Recent Transaction</h5>
                    <ul class="list-group">
                        @forelse ($recentlyTransactions as $transaction)
                            <li class="list-group-item"><span class="text-primary">{{ $transaction->user->name }}</span> From Classroom {{ $transaction->user->classroom->title }} Bill Amount Rp. <span class="text-success">{{ number_format($transaction->bill) }}</span></li>
                        @empty
                            
                        @endforelse    
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Total Bill <span class="text-primary fw-bold">{{ $bill }}</span></td>
                                    <td class="text-end"><a wire:navigate href="{{ route('bills.index') }}" class="btn btn-secondary btn-sm shadow-sm">View Detail</a></td>
                                </tr>
                                <tr>
                                    <td>Total Transaction Paid <span class="text-success fw-bold">{{ $paid }}</span></td>
                                    <td class="text-end"><a wire:navigate href="{{ route('transactions.paid') }}" class="btn btn-secondary btn-sm shadow-sm">View Detail</a></td>
                                </tr>
                                <tr>
                                    <td>Total Transaction Waiting Confirmed <span class="text-warning">{{ $confirm }}</span></td>
                                    <td class="text-end"><a wire:navigate href="{{ route('transactions.waiting') }}" class="btn btn-secondary btn-sm shadow-sm">View Detail</a></td>
                                </tr>
                                <tr>
                                    <td>Total Transaction Cancel <span class="text-danger">{{ $cancel }}</span></td>
                                    <td class="text-end"><a wire:navigate href="{{ route('transactions.cancel') }}" class="btn btn-secondary btn-sm shadow-sm">View Detail</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>