@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')

<div class="page-header mb-3">

    <div>
        <div class="page-pretitle">
            Peminjaman Arsip
        </div>

        <h2 class="page-title">
            Detail Peminjaman
        </h2>
    </div>

    <div>
        <a
            href="{{ route('user.borrowings.index') }}"
            class="btn btn-secondary"
        >
            Kembali
        </a>
    </div>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="row row-cards">

    {{-- Informasi Peminjaman --}}

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Informasi Peminjaman
                </h3>

            </div>


            <div class="card-body">

                <dl class="row">

                    <dt class="col-sm-4">
                        Pemohon
                    </dt>

                    <dd class="col-sm-8">
                        {{ $borrowing->user->name ?? '-' }}
                    </dd>


                    <dt class="col-sm-4">
                        Jabatan
                    </dt>

                    <dd class="col-sm-8">
                        {{ $borrowing->user->jabatan->nama ?? '-' }}
                    </dd>


                    <dt class="col-sm-4">
                        Jenis Layanan
                    </dt>

                    <dd class="col-sm-8">

                        @if($borrowing->jenisLayanan)

                            {{ $borrowing->jenisLayanan->nama }}

                            <span class="text-secondary">
                                ({{ $borrowing->jenisLayanan->jangka_peminjaman }}
                                hari)
                            </span>

                        @else

                            -

                        @endif

                    </dd>


                    <dt class="col-sm-4">
                        Jenis Peminjaman
                    </dt>

                    <dd class="col-sm-8">

                        {{ config(
                            'archive.jenis_peminjaman.' .
                            $borrowing->jenis_peminjaman,
                            '-'
                        ) }}

                    </dd>


                    <dt class="col-sm-4">
                        Tanggal Pengajuan
                    </dt>

                    <dd class="col-sm-8">

                        {{ $borrowing->tanggal_pengajuan?->format('d M Y') ?? '-' }}

                    </dd>


                    <dt class="col-sm-4">
                        Tanggal Peminjaman
                    </dt>

                    <dd class="col-sm-8">

                        {{ $borrowing->tanggal_peminjaman?->format('d M Y') ?? '-' }}

                    </dd>


                    <dt class="col-sm-4">
                        Batas Pengembalian
                    </dt>

                    <dd class="col-sm-8">

                        @if($borrowing->batas_pengembalian)

                            <span class="fw-bold">

                                {{ $borrowing->batas_pengembalian->format('d M Y') }}

                            </span>

                        @else

                            -

                        @endif

                    </dd>


                    <dt class="col-sm-4">
                        Tanggal Dikembalikan
                    </dt>

                    <dd class="col-sm-8">

                        {{ $borrowing->tanggal_pengembalian?->format('d M Y') ?? '-' }}

                    </dd>


                    <dt class="col-sm-4">
                        Keperluan
                    </dt>

                    <dd class="col-sm-8">

                        {{ $borrowing->keperluan }}

                    </dd>

                </dl>

            </div>

        </div>


        {{-- Informasi Arsip --}}

        <div class="card mt-3">

            <div class="card-header">

                <h3 class="card-title">
                    Informasi Arsip
                </h3>

            </div>

            <div class="card-body">

                @if($borrowing->archive)

                    <dl class="row mb-0">

                        <dt class="col-sm-4">
                            Nomor Berkas
                        </dt>

                        <dd class="col-sm-8">
                            {{ $borrowing->archive->nomor_berkas }}
                        </dd>


                        <dt class="col-sm-4">
                            Judul
                        </dt>

                        <dd class="col-sm-8">
                            {{ $borrowing->archive->judul }}
                        </dd>


                        <dt class="col-sm-4">
                            Jenis Arsip
                        </dt>

                        <dd class="col-sm-8">
                            {{ $borrowing->archive->jenis_arsip }}
                        </dd>


                        <dt class="col-sm-4">
                            Tanggal Dokumen
                        </dt>

                        <dd class="col-sm-8">
                            {{ $borrowing->archive->tanggal_dokumen?->format('d M Y') ?? '-' }}
                        </dd>

                    </dl>

                @else

                    <div class="text-secondary">
                        Data arsip tidak ditemukan.
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- Status --}}

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Status Peminjaman
                </h3>

            </div>


            <div class="card-body">

                @php

                    $status = match($borrowing->status) {

                        'pending' =>
                            [
                                'Diajukan',
                                'bg-blue-lt'
                            ],

                        'approved' =>
                            [
                                'Disetujui Pimpinan',
                                'bg-green-lt'
                            ],

                        'preparing' =>
                            [
                                'Diproses oleh Petugas',
                                'bg-yellow-lt'
                            ],

                        'ready' =>
                            [
                                'Siap Diambil',
                                'bg-cyan-lt'
                            ],

                        'borrowed' =>
                            [
                                'Sedang Dipinjam',
                                'bg-orange-lt'
                            ],

                        'returned' =>
                            [
                                'Dikembalikan',
                                'bg-green-lt'
                            ],

                        'rejected' =>
                            [
                                'Ditolak',
                                'bg-red-lt'
                            ],

                        'cancelled' =>
                            [
                                'Dibatalkan',
                                'bg-secondary-lt'
                            ],

                        default =>
                            [
                                $borrowing->status,
                                'bg-secondary-lt'
                            ],

                    };

                @endphp


                <div class="text-center">

                    <span class="badge {{ $status[1] }} fs-3">

                        {{ $status[0] }}

                    </span>

                </div>

            </div>

        </div>


        {{-- Persetujuan --}}

        @if($borrowing->approved_at)

            <div class="card mt-3">

                <div class="card-header">

                    <h3 class="card-title">
                        Persetujuan Kepala Kantor
                    </h3>

                </div>

                <div class="card-body">

                    <div class="mb-2">
                        <strong>
                            Disetujui oleh:
                        </strong>
                    </div>

                    <div>
                        {{ $borrowing->approver->name ?? '-' }}
                    </div>

                    <div class="text-secondary mt-1">
                        {{ $borrowing->approved_at->format('d M Y H:i') }}
                    </div>

                </div>

            </div>

        @endif


        {{-- Aksi Pengembalian --}}

        @if($borrowing->status === 'borrowed')

            @can('borrowings.cancel')

                <div class="card mt-3">

                    <div class="card-body">

                        <form
                            action="{{ route(
                                'user.borrowings.return',
                                $borrowing
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Apakah arsip sudah dikembalikan?'
                            )"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-success w-100"
                            >
                                Tandai Arsip Dikembalikan
                            </button>

                        </form>

                    </div>

                </div>

            @endcan

        @endif

    </div>

</div>

@endsection