<x-master-layout title="Checkout">

    @section('header')
        <h4 class="text-center">Checkout</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8 col-sm-12">
            <div class="card border-0 shadow-smooth p-3">
                <div class="card-body">
                    <form action="{{ route('checkouts_cash.store', $checkout->uuid) }}" method="post">
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
                            <div class="d-block">
                                <label for="" class="form-label">Payment Account</label>
                                <select name="payment_account" class="form-select">
                                    @foreach ($paymentAccount as $account)
                                        <option value="{{ $account->id }}">{{ $account->account_name }} - {{ $account->account_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary shadow px-4">Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>