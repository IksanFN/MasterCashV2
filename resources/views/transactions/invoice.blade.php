<x-master-layout title="Invoice">

    @section('header')
        <h4 class="text-center">Invoice</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8">
            <a href="{{ route('transactions.paid') }}" class="btn btn-outline-dark shadow-smooth">Back</a>
            <a href="" class="btn btn-danger shadow-smooth">PDF</a>
            <div class="card border-0 shadow-smooth p-3 mt-3">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h4><strong>{{ $invoice->transaction_code }}</strong></h4>
                            <p class="mb-0">Bill for : <strong>{{ $invoice->week->title }}, {{ $invoice->month->title }} {{ $invoice->year->title }}</strong></p>
                        </div>
                        <div class="col-md-6 text-end">
                            <h4 class="fw-bold text-primary">SanCash</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0">Bill From:</p>
                            <p class="fw-bold">SMK Taruna Harapan 1 Cipatat</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="mb-0">Bill To:</p>
                            <p class="fw-bold mb-0">{{ $invoice->user->name }}</p>
                            <p>{{ $invoice->user->classroom->title }}</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            {{-- <thead>
                                <tr class="bg-light">
                                    <th>Nama</th>
                                    <th style="text-align: right;">Nilai</th>
                                </tr>
                            </thead> --}}
                            <tbody>
                                <tr>
                                    <td>Student Name</td>
                                    <td style="text-align: right;">{{ $invoice->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Classroom</td>
                                    <td style="text-align: right;">{{ $invoice->user->classroom->title }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td style="text-align: right;">{{ $invoice->payment_status }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Date</td>
                                    <td style="text-align: right;">{{ $invoice->payment_date }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td style="text-align: right;">{{ $invoice->paymentAccount->account_title }}</td>
                                </tr>
                                <tr>
                                    <td>Bill</td>
                                    <td style="text-align: right;">IDR {{ number_format($invoice->bill) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <p class="text-center mb-0">Terima kasih atas partisipasinya terhadap kelas dan lingkungan sekolah.</p>
                    <p class="text-center">SanCash.</p>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>