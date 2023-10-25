<x-master-layout title="Create Bill">

    @section('header')
        <h4 class="text-center">Create Bill by Classroom</h4>
    @endsection

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card border-0 shadow-smooth p-2">
                <div class="card-body">
                    <form action="{{ route('bills.store_by_classroom') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Classroom</label>
                            <select name="classroom" class="form-control">
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
                            <label for="" class="form-label">Year</label>
                            <select name="year" class="form-control">
                                <option value="default" hidden>Choose Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->title }}</option>
                                @endforeach
                            </select>
                            @error('year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Month</label>
                            <select name="month" class="form-control">
                                <option value="default" hidden>Choose Month</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->title }}</option>
                                @endforeach
                            </select>
                            @error('month')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Week</label>
                            <select name="week" class="form-control">
                                <option value="default" hidden>Choose Week</option>
                                @foreach ($weeks as $week)
                                    <option value="{{ $week->id }}">{{ $week->title }}</option>
                                @endforeach
                            </select>
                            @error('week')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Bill</label>
                            <input type="number" name="bill" step=".01" min="0.01" max="99999999" class="form-control" placeholder="Enter nominal">
                            @error('bill')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-secondary shadow-sm px-5">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>