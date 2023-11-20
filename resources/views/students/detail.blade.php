<x-master-layout title="Detail Student">

    @section('header')
        <h4>Detail Student</h4>
    @endsection

    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 px-3 py-2">
                <div class="card-body">
                    @if ($student->avatar)
                        <img src="{{ asset('storage/avatar/'.$student->avatar) }}" alt="" class="img-fluid rounded">
                    @else
                        <div class="text-center">Nothing Avatar</div>
                    @endif
                </div>
            </div>
            <a wire:navigate href="{{ route('students.index') }}" class="btn btn-secondary mt-3 shadow-smooth mb-2">Back</a>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 px-3 py-2">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center fw-medium h5 pb-4">Profile Student</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Name</td>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">NISN</td>
                                    <td>{{ $student->nisn }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Phone Number</td>
                                    <td>{{ $student->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Gender</td>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Classroom</td>
                                    <td>{{ $student->classroom->title }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Major</td>
                                    <td>{{ $student->major->title }} - {{ $student->major->major_code }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Address</td>
                                    <td>{{ $student->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>