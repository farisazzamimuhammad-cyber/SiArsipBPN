@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="mb-4">

        <a
            href="{{ route('staff.borrowings.index') }}"
            class="btn btn-secondary mb-3"
        >
            Kembali
        </a>

        <h1 class="h2">
            Detail Peminjaman
        </h1>

    </div>

    <div class="row row-cards">

        {{-- Pemohon --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Informasi Pemohon
                    </h3>
                </div>

                <div class="card-body">

                    <dl class="row">

                        <dt class="col-5">
                            Nama
                        </dt>

                        <dd class="col-7">
                            {{ $borrowing->user->name ?? '-' }}
                        </dd>

                        <dt class="col-5">
                            Email
                        </dt>

                        <dd class="col-7">
                            {{ $borrowing->user->email ?? '-' }}
                        </dd>

                    </dl>

                </div>

            </div>

        </div>


        {{-- Arsip --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Informasi Arsip
                    </h3>
                </div>

                <div class="card-body">

                    <dl class="row">

                        <dt class="col-5">
                            Nomor Berkas
                        </dt>

                        <dd class="col-7">
                            {{ $borrowing->archive->nomor_berkas ?? '-' }}
                        </dd>

                        <dt class="col-5">
                            Judul
                        </dt>

                        <dd class="col-7">
                            {{ $borrowing->archive->judul ?? '-' }}
                        </dd>

                        <dt class="col-5">
                            Jenis Arsip
                        </dt>

                        <dd class="col-7">
                            {{ $borrowing->archive->jenis_arsip ?? '-' }}
                        </dd>

                    </dl>

                </div>

            </div>

        </div>


        {{-- Proses --}}
        <div class="col-12">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Proses Arsip
                    </h3>
                </div>

                <div class="card-body">

                    <dl class="row">

                        <dt class="col-md-3">
                            Keperluan
                        </dt>

                        <dd class="col-md-9">
                            {{ $borrowing->keperluan }}
                        </dd>

                        <dt class="col-md-3">
                            Tanggal Peminjaman
                        </dt>

                        <dd class="col-md-9">
                            {{ $borrowing->tanggal_peminjaman?->format('d/m/Y') ?? '-' }}
                        </dd>

                        <dt class="col-md-3">
                            Status
                        </dt>

                        <dd class="col-md-9">

                            @if($borrowing->status === 'approved')

                                <span class="badge bg-success">
                                    Disetujui
                                </span>

                            @elseif($borrowing->status === 'preparing')

                                <span class="badge bg-warning text-dark">
                                    Sedang Disiapkan
                                </span>

                            @elseif($borrowing->status === 'ready')

                                <span class="badge bg-primary">
                                    Siap Diambil
                                </span>

                            @endif

                        </dd>

                    </dl>

                </div>


               <div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Aksi Peminjaman</h3>
    </div>

    <div class="card-body">

        @if($borrowing->status === 'approved')

            @can('borrowings.prepare')
                <form action="{{ route('staff.borrowings.prepare', $borrowing) }}"
                      method="POST"
                      onsubmit="return confirm('Mulai menyiapkan arsip ini?')">
                    @csrf

                    <button type="submit" class="btn btn-primary">
                        Mulai Siapkan Arsip
                    </button>
                </form>
            @endcan

        @elseif($borrowing->status === 'preparing')

            @can('borrowings.confirm')
                <form action="{{ route('staff.borrowings.ready', $borrowing) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah arsip sudah siap diambil?')">
                    @csrf

                    <button type="submit" class="btn btn-success">
                        Arsip Sudah Siap
                    </button>
                </form>
            @endcan

        @elseif($borrowing->status === 'ready')

            @can('borrowings.confirm')
                <form action="{{ route('staff.borrowings.borrowed', $borrowing) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah arsip sudah diserahkan kepada peminjam?')">
                    @csrf

                    <button type="submit" class="btn btn-primary">
                        Konfirmasi Arsip Diserahkan
                    </button>
                </form>
            @endcan

        @elseif($borrowing->status === 'borrowed')

            <div class="alert alert-info mb-0">
                Arsip sedang dipinjam oleh {{ $borrowing->user->name }}.
            </div>

        @elseif($borrowing->status === 'returned')

            <div class="alert alert-success mb-0">
                Arsip telah dikembalikan oleh peminjam.
            </div>

        @elseif($borrowing->status === 'rejected')

            <div class="alert alert-danger mb-0">
                Pengajuan peminjaman ditolak.
            </div>

        @endif

    </div>
</div>

            </div>

        </div>

    </div>

</div>

@endsection