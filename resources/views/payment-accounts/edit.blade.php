<x-master-layout title="Edit Account">

    @section('header')
        <h4 class="text-center">Edit Account</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">
                    <form action="{{ route('payment_accounts.update', $paymentAccount) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="account_name" value="{{ $paymentAccount->account_name }}">
                            @error('account_name')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="account_title" value="{{ $paymentAccount->account_title }}">
                            @error('account_title')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" class="form-control" name="account_number" value="{{ $paymentAccount->account_number }}">
                            @error('account_number')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <select name="account_type" class="form-select">
                                <option value="default" hidden>Choose Type Account</option>
                                <option value="Bank" {{ ($paymentAccount->account_type == 'Bank') ? 'selected' : '' }}>Bank</option>
                                <option value="E-Wallet" {{ ($paymentAccount->account_type == 'E-Wallet') ? 'selected' : '' }}>E-Wallet</option>
                                <option value="Treasurer Wallet" {{ ($paymentAccount->account_type == 'Treasurer Wallet') ? 'selected' : '' }}>Treasurer Wallet</option>
                            </select>
                            @error('account_type')
                                <span class="text-danger form-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-dark px-5 shadow-smooth">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>