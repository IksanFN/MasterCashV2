<section class="row">
    <header>
        <h5 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h5>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <div class="col-md-6 col-lg-6">
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
    
            <div class="mb-2">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                @error('current_password')
                    <span class="text-danger form-text">{{ $message }}</span>
                @enderror
            </div>
    
            <div>
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <span class="text-danger form-text">{{ $message }}</span>
                @enderror
            </div>
    
            <div>
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password_confirmation" class="form-control" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                    <span class="text-danger form-text">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex items-center gap-4">
                <button type="submit" class="btn btn-dark px-4 shadow-sm mt-3">Save</button>
                @if (session('status') === 'password-updated')
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
