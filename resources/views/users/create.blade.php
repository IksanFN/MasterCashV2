<x-master-layout>

    @section('header')
        <h4 class="text-center">Create Users</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">

                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                            @error('avatar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NISN</label>
                            <input type="text" class="form-control" name="nisn">
                            @error('nisn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Classroom</label>
                            <select name="classroom" class="form-select">
                                <option value="default" hidden>Choose Classroom</option>
                                @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->title }}</option>
                                @endforeach
                            </select>
                            @error('classroom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Major</label>
                            <select name="major" class="form-select">
                                <option value="default" hidden>Choose Major</option>
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->title }}</option>
                                @endforeach
                            </select>
                            @error('major')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      Laki-laki
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      Perempuan
                                    </label>
                                </div>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-dark px-4">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>