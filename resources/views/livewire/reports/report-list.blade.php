<div class="">
    <div class="card border-0 p-3">
        <div class="card-body">
            <div class="alert alert-secondary border-0 text-center" role="alert">
                Please do a filter to export data
            </div>
            
            <div class="row pt-3 gap-2 mb-3 justify-content-center">
                <div class="col-md-3">
                    <label class="form-label">Classroom</label>
                    <select wire:model.live='classroom' class="form-select">
                        <option value="" selected>All Class</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status Transaction</label>
                    <select wire:model.live='status' id="" class="form-select">
                        <option value="">All</option>
                        <option value="Unpaid">Unpaid</option>
                        <option value="Paid">Paid</option>
                        <option value="Cancel">Cancel</option>
                        <option value="Waiting">Confirm</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Year</label>
                    <select wire:model.live='year' class="form-select">
                        <option value="">All Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row gap-2 justify-content-center">
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <select wire:model.live='month' class="form-select">
                        <option value="">All Month</option>
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}">{{ $month->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Week</label>
                    <select wire:model.live='week' class="form-select">
                        <option value="">All Week</option>
                        @foreach ($weeks as $week)
                            <option value="{{ $week->id }}">{{ $week->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Payment Method</label>
                    <select wire:model.live='week' class="form-select">
                        <option value="">All Week</option>
                        @foreach ($paymentAccount as $account)
                            <option value="{{ $account->id }}">{{ $account->account_type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center mt-3">
                <button wire:click='export' class="btn btn-dark">Export Report</button>
            </div>
        </div>
    </div>
</div>