@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')

<div class="page-header mb-3">

    <div>

        <div class="page-pretitle">
            Peminjaman Arsip
        </div>

        <h2 class="page-title">
            Ajukan Peminjaman
        </h2>

    </div>

</div>


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


<div class="card">

    <div class="card-body">

        <form
            action="{{ route('user.borrowings.store') }}"
            method="POST"
        >

            @csrf


            {{-- Jenis Layanan --}}

            <div class="mb-3">

                <label class="form-label">
                    Jenis Layanan
                </label>

                <select
                    name="jenis_layanan_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        Pilih Jenis Layanan
                    </option>

                    @foreach($jenisLayanans as $jenisLayanan)

                        <option
                            value="{{ $jenisLayanan->id }}"
                            {{ old('jenis_layanan_id') == $jenisLayanan->id ? 'selected' : '' }}
                        >

                            {{ $jenisLayanan->kode }}
                            -
                            {{ $jenisLayanan->nama }}

                            ({{ $jenisLayanan->jangka_peminjaman }} hari)

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Jenis Peminjaman --}}

            <div class="mb-3">

                <label class="form-label">
                    Jenis Peminjaman
                </label>

                <select
                    name="jenis_peminjaman"
                    class="form-select"
                    required
                >

                    <option value="">
                        Pilih Jenis Peminjaman
                    </option>

                    @foreach($jenisPeminjaman as $kode => $nama)

                        <option
                            value="{{ $kode }}"
                            {{ old('jenis_peminjaman') === $kode ? 'selected' : '' }}
                        >

                            {{ $nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Arsip --}}

            <div class="mb-3">

                <label class="form-label">
                    Arsip
                </label>

                <select
                    name="archive_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        Pilih Arsip
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


            {{-- Tanggal Peminjaman --}}

            <div class="mb-3">

                <label class="form-label">
                    Rencana Tanggal Peminjaman
                </label>

                <input
                    type="date"
                    name="tanggal_peminjaman"
                    value="{{ old('tanggal_peminjaman') }}"
                    class="form-control"
                    min="{{ date('Y-m-d') }}"
                    required
                >

            </div>


            {{-- Keperluan --}}

            <div class="mb-3">

                <label class="form-label">
                    Keperluan
                </label>

                <textarea
                    name="keperluan"
                    rows="4"
                    class="form-control"
                    placeholder="Jelaskan keperluan peminjaman arsip..."
                    required
                >{{ old('keperluan') }}</textarea>

            </div>


            <div class="d-flex justify-content-end gap-2">

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
                    Ajukan Peminjaman
                </button>

            </div>

        </form>

    </div>

</div>

@endsection