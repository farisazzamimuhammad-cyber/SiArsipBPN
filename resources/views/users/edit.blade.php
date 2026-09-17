@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-header mb-3">

    <div>

        <div class="page-pretitle">
            Pengguna
        </div>

        <h2 class="page-title">
            Edit Pengguna
        </h2>

    </div>

</div>

<div class="card">

    <div class="card-body">

        <form action="{{ route('users.update', $user->id) }}"
              method="POST">

            @csrf

            @method('PUT')

            {{-- NAME --}}
            <div class="mb-3">

                <label class="form-label">
                    Nama
                </label>

                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}"
                       placeholder="Masukkan nama"
                       required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- EMAIL --}}
            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}"
                       placeholder="Masukkan email"
                       required>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- ROLE --}}
            <div class="mb-3">

                <label class="form-label">
                    Role
                </label>

                <select name="role"
                        class="form-select @error('role') is-invalid @enderror"
                        required>

                    <option value="">
                        Pilih Role
                    </option>

                    @foreach($roles as $role)

                        <option value="{{ $role->name }}"
                            {{ old('role', $currentRole?->name) === $role->name ? 'selected' : '' }}>

                            {{ $role->display_name ?? $role->name }}

                        </option>

                    @endforeach

                </select>

                @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">

                <label class="form-label">
                    Password Baru
                </label>

                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Kosongkan jika tidak ingin mengubah password">

                <div class="form-hint">
                    Minimal 8 karakter jika ingin mengubah password.
                </div>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="mb-3">

                <label class="form-label">
                    Konfirmasi Password
                </label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password baru">

            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('users.index') }}"
                   class="btn btn-secondary">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-primary">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection