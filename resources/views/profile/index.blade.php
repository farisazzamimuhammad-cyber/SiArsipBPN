@extends('layouts.app')

@section('title', 'Akun Saya - SIARSIP BPN')

@section('content')

<div class="container-xl">

    <div class="mb-4">

        <h1 class="h2">
            Akun Saya
        </h1>

        <p class="text-secondary">
            Kelola informasi akun dan password Anda.
        </p>

    </div>


    {{-- Pesan berhasil --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="row row-cards">


        {{-- INFORMASI AKUN --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Informasi Akun
                    </h3>

                </div>


                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $user->name }}"
                            disabled
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            value="{{ $user->email }}"
                            disabled
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Role
                        </label>

                        <div>

                            @if($user->hasRole('Admin'))

                                <span class="badge bg-danger">
                                    Pimpinan / Admin
                                </span>

                            @elseif($user->hasRole('Staff'))

                                <span class="badge bg-primary">
                                    Staff
                                </span>

                            @elseif($user->hasRole('User'))

                                <span class="badge bg-success">
                                    User
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- UBAH PROFIL --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Ubah Profil
                    </h3>

                </div>


                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label required">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label required">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required
                            >

                        </div>

                    </div>


                    <div class="card-footer">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- GANTI PASSWORD --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Ganti Password
                    </h3>

                </div>


                <form
                    action="{{ route('profile.password') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label required">
                                Password Lama
                            </label>

                            <input
                                type="password"
                                name="password_lama"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label required">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_baru"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label required">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_baru_confirmation"
                                class="form-control"
                                required
                            >

                        </div>

                    </div>


                    <div class="card-footer">

                        <button
                            type="submit"
                            class="btn btn-warning"
                        >
                            Ubah Password
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection