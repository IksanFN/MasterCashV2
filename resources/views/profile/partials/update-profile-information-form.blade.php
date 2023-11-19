<section class="row">
    <header>
        <h5 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h5>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="col-md-6 col-m">
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
    
            <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                    <span class="text-danger form-text"></span>
                @enderror
            </div>
    
            <div>
                <label for="name" class="form-label">Email</label>
                <input type="text" class="form-control" value="{{ old('name', $user->email) }}">
            </div>
    
            <div class="flex items-center gap-4">
                <button type="submit" class="btn btn-dark px-4 mt-3">Save</button>
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
