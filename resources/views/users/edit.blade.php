<x-master-layout>

    @section('header')
        <h4>Edit Users</h4>
    @endsection

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card border-0 shadow-smooth">
                <div class="card-body">

                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="" class="form-label">Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-master-layout>