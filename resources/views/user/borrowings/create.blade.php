@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="mb-4">
        <h1 class="h2">Ajukan Peminjaman Arsip</h1>

        <p class="text-secondary">
            Silakan lengkapi data pengajuan peminjaman arsip.
        </p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Form Peminjaman
            </h3>
        </div>

        <form action="{{ route('user.borrowings.store') }}" method="POST">

            @csrf

            <div class="card-body">

                {{-- Arsip --}}
                <div class="mb-3">

                    <label class="form-label required">
                        Pilih Arsip
                    </label>

                    <select
                        name="archive_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Arsip --
                        </option>

                        @foreach($archives as $archive)

                            <option
                                value="{{ $archive->id }}"
                                {{ old('archive_id') == $archive->id ? 'selected' : '' }}
                            >
                                {{ $archive->nomor_berkas }}
                                -
                                {{ $archive->judul }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Tanggal --}}
                <div class="mb-3">

                    <label class="form-label required">
                        Tanggal Peminjaman
                    </label>

                    <input
                        type="date"
                        name="tanggal_peminjaman"
                        class="form-control"
                        value="{{ old('tanggal_peminjaman') }}"
                        required
                    >

                </div>

                {{-- Keperluan --}}
                <div class="mb-3">

                    <label class="form-label required">
                        Keperluan Peminjaman
                    </label>

                    <textarea
                        name="keperluan"
                        class="form-control"
                        rows="5"
                        placeholder="Jelaskan keperluan peminjaman arsip..."
                        required
                    >{{ old('keperluan') }}</textarea>

                </div>

            </div>

            <div class="card-footer d-flex justify-content-end gap-2">

                <a
                    href="{{ route('user.borrowings.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Kirim Pengajuan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection