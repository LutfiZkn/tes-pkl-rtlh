<div class="mb-3">
    <label for="name" class="form-label">Nama</label>

    <input
    type="text"
    name="name"
    id="name"
    class="form-control @error('name') is-invalid @enderror"
    value="{{ old('name', $user->name ?? '') }}"
    {{ isset($readonly) && $readonly ? 'readonly' : '' }}
    required>

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>

        <input
        type="text"
        name="username"
        id="username"
        class="form-control @error('username') is-invalid @enderror"
        value="{{ old('username', $user->username ?? '') }}"
        {{ isset($readonly) && $readonly ? 'readonly' : '' }}
        required>

        @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    @if(!isset($readonly) || !$readonly)
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>

            @if(isset($user))
                <small class="text-muted d-block mb-1">Kosongkan jika tidak ingin mengubah password</small>
            @endif

            <input
            type="password"
            name="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            {{ isset($user) ? '' : 'required' }}>

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    @endif

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>

        <select 
        name="role" 
        id="role" 
        class="form-select @error('role') is-invalid @enderror" 
        {{ isset($readonly) && $readonly ? 'disabled' : '' }} 
        {{ isset($user) && Auth::id() === $user->id ? 'disabled' : '' }} required>
            <option value="">--Pilih Role--</option>
            <option value="Admin" {{ old('role', $user->role ?? '') === 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Petugas" {{ old('role', $user->role ?? '') === 'Petugas' ? 'selected' : '' }}>Petugas</option>
        </select>

        @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>