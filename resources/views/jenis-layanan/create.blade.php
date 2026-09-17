@extends('layouts.app')

@section('title', 'Tambah Jenis Layanan')

@section('content')

<div class="page-header mb-3">

    <div>

        <div class="page-pretitle">
            Master Data
        </div>

        <h2 class="page-title">
            Tambah Jenis Layanan
        </h2>

    </div>

</div>


<div class="card">

    <div class="card-body">

        <form
            action="{{ route('jenis-layanan.store') }}"
            method="POST"
        >

            @csrf


            <div class="mb-3">

                <label class="form-label">
                    Kode
                </label>

                <input
                    type="text"
                    name="kode"
                    value="{{ old('kode') }}"
                    class="form-control @error('kode') is-invalid @enderror"
                    placeholder="Contoh: SL001"
                    required
                >

                @error('kode')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Jenis Layanan
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Contoh: Sengketa Perkara"
                    required
                >

                @error('nama')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Jangka Peminjaman
                </label>

                <div class="input-group">

                    <input
                        type="number"
                        name="jangka_peminjaman"
                        value="{{ old('jangka_peminjaman') }}"
                        class="form-control @error('jangka_peminjaman') is-invalid @enderror"
                        min="1"
                        placeholder="Contoh: 7"
                        required
                    >

                    <span class="input-group-text">
                        Hari
                    </span>

                </div>

                @error('jangka_peminjaman')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('jenis-layanan.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection