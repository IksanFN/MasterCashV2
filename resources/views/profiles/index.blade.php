<x-master-layout title="Profile">

    @section('header')
        <h4>My Profile</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-12 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="text-danger form-text">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-danger form-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>