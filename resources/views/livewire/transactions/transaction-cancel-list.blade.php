<div>
    <div class="card border-0 p-2">
        <div class="card-body">
            <div class="row gap-2">
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
                        <th>Cancel Date</th>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($transactions as $transaction)
                            <tr wire:key='{{ $transaction->id }}'>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->user->classroom->title }}</td>
                                <td>{{ number_format($transaction->bill) }}</td>
                                <td>{{ $transaction->week->title }}, {{ $transaction->month->title }} {{ $transaction->year->title }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $transaction->payment_status }}</span>
                                </td>
                                <td>{{ $transaction->payment_date }}</td>
                                <td>{{ $transaction->cancel_date }}</td>
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