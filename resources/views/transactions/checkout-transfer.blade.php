<x-master-layout title="Checkout Transfer">

    @section('header')
        <h4 class="text-center">Checkout Transfer</h4>
    @endsection

    <div class="row justify-content-center mb-4 mt-5">
        <div class="col-lg-10">
            <p class="text-center">Please transfer to one of the payment accounts below</p>
            <div class="row">
                @foreach ($paymentAccounts as $account)
                <div class="col-md-2 col-lg-4">
                    <div class="card border-0 p-2 shadow-smooth">
                        <div class="card-body align-items-center text-center">
                            <h5>{{ $account->account_name }}</h5>
                            <span class="d-block text-primary">{{ $account->account_number }}</span>
                            <span class="text-success">{{ $account->account_title }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-10">
            <p class="text-center">Please confirm payment</p>
            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">

                    <form action="{{ route('transactions.payment_transfer.store_checkout', $checkout->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">NISN</label>
                                    <input type="text" name="nisn" class="form-control" value="{{ $checkout->user->nisn }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $checkout->user->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $checkout->user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Classroom</label>
                                    <input type="text" name="classroom" class="form-control" value="{{ $checkout->user->classroom->title }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Bill Code</label>
                                    <input type="text" name="bill_code" class="form-control" value="{{ $checkout->bill_code }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Bill</label>
                                    <input type="text" name="bill" class="form-control" value="{{ $checkout->bill }}" readonly>
                                </div>
                            </div>
                            <div class="d-block mb-3">
                                <label for="" class="form-label">Receipt</label>
                                <input type="file" name="payment_receipt" class="form-control">
                                @error('payment_receipt')
                                    <span class="text-danger form-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-block">
                                <label for="" class="form-label">Payment Account</label>
                                <select name="payment_account" class="form-select">
                                    <option value="default" hidden>Choose Payment Account</option>
                                    @foreach ($paymentAccounts as $paymentAccount)
                                        <option value="{{ $paymentAccount->id }}">{{ $paymentAccount->account_name }} - {{ $paymentAccount->account_title }}</option>
                                    @endforeach
                                </select>
                                @error('payment_account')
                                    <span class="text-danger form-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-block mt-3">
                                <label for="" class="form-label">Note</label>
                                <textarea name="payment_description" class="form-control"></textarea>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary shadow px-4">Pay Now</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>