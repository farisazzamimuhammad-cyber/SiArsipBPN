@extends('layouts.app')

@section('content')

<div class="container-xl">

    {{-- Header --}}
    <div class="mb-4">

        <h1 class="h2">
            Dashboard Pimpinan
        </h1>

        <p class="text-secondary">
            Selamat datang, {{ auth()->user()->name }}.
            Kelola dan pantau pengajuan peminjaman arsip.
        </p>

    </div>


    {{-- Statistik --}}
    <div class="row row-cards mb-4">

        {{-- Total User --}}
        <div class="col-sm-6 col-lg-3">

            <div class="card">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div>
                            <div class="text-secondary">
                                Total Pengguna
                            </div>

                            <div class="h1 mb-0">
                                {{ $totalUsers }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Total Arsip --}}
        <div class="col-sm-6 col-lg-3">

            <div class="card">

                <div class="card-body">

                    <div class="text-secondary">
                        Total Arsip
                    </div>

                    <div class="h1 mb-0">
                        {{ $totalArchives }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="col-sm-6 col-lg-3">

            <div class="card">

                <div class="card-body">

                    <div class="text-secondary">
                        Menunggu Persetujuan
                    </div>

                    <div class="h1 mb-0 text-warning">
                        {{ $pendingBorrowings }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Dipinjam --}}
        <div class="col-sm-6 col-lg-3">

            <div class="card">

                <div class="card-body">

                    <div class="text-secondary">
                        Sedang Dipinjam
                    </div>

                    <div class="h1 mb-0">
                        {{ $borrowedBorrowings }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Status Peminjaman --}}
    <div class="row row-cards">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Status Peminjaman
                    </h3>

                </div>

                <div class="list-group list-group-flush">

                    <div class="list-group-item d-flex justify-content-between">

                        <span>
                            Menunggu Persetujuan
                        </span>

                        <span class="badge bg-warning text-dark">
                            {{ $pendingBorrowings }}
                        </span>

                    </div>


                    <div class="list-group-item d-flex justify-content-between">

                        <span>
                            Disetujui
                        </span>

                        <span class="badge bg-success">
                            {{ $approvedBorrowings }}
                        </span>

                    </div>


                    <div class="list-group-item d-flex justify-content-between">

                        <span>
                            Ditolak
                        </span>

                        <span class="badge bg-danger">
                            {{ $rejectedBorrowings }}
                        </span>

                    </div>


                    <div class="list-group-item d-flex justify-content-between">

                        <span>
                            Sedang Dipinjam
                        </span>

                        <span class="badge bg-primary">
                            {{ $borrowedBorrowings }}
                        </span>

                    </div>


                    <div class="list-group-item d-flex justify-content-between">

                        <span>
                            Dikembalikan
                        </span>

                        <span class="badge bg-secondary">
                            {{ $returnedBorrowings }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Aksi --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Pengelolaan
                    </h3>

                </div>

                <div class="card-body">

                    <p class="text-secondary">
                        Kelola pengajuan peminjaman arsip dan lakukan
                        persetujuan terhadap permintaan pengguna.
                    </p>

                    @can('borrowings.view')

                        <a
                            href="{{ route('admin.borrowings.index') }}"
                            class="btn btn-primary"
                        >
                            Lihat Pengajuan Peminjaman
                        </a>

                    @endcan

                </div>

            </div>

        </div>

    </div>

</div>

@endsection