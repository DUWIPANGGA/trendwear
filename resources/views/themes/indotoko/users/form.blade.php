<!-- resources/views/themes/indotoko/users/form.blade.php -->
@php
    $isEdit = isset($user);
    $route = $isEdit ? route('users.update', $user->id) : route('users.store');
@endphp

<form method="POST" action="{{ $route }}">
    @if($isEdit) @method('PUT') @endif
    @csrf
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Edit' : 'Add' }} User</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name ?? '') }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email ?? '') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">{{ $isEdit ? 'New ' : '' }}Password</label>
                <input type="password" name="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       {{ $isEdit ? '' : 'required' }}>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            @if($isEdit)
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control">
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>