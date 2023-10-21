<x-master-layout>

    @section('header')
        <h4 class="text-center">Create Users</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">

                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="" class="form-label">Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
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