@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')

<div class="page-header mb-4">
    <div>
        <h2 class="page-title">Dashboard Staff</h2>
        <div class="text-muted">
            Kelola dan siapkan arsip yang telah disetujui.
        </div>
    </div>
</div>

<div class="row row-cards">

    {{-- Disetujui --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="text-muted">Disetujui</div>
                        <div class="h1 mb-0">
                            {{ $approvedBorrowings }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sedang Disiapkan --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="text-muted">Sedang Disiapkan</div>
                        <div class="h1 mb-0">
                            {{ $preparingBorrowings }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Siap Diambil --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="text-muted">Siap Diambil</div>
                        <div class="h1 mb-0">
                            {{ $readyBorrowings }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sedang Dipinjam --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="text-muted">Sedang Dipinjam</div>
                        <div class="h1 mb-0">
                            {{ $borrowedBorrowings }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row row-cards mt-3">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Alur Peminjaman Arsip</h3>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <strong>1. Disetujui</strong>
                    <div class="text-muted">
                        Pengajuan telah disetujui oleh Pimpinan.
                    </div>
                </div>

                <div class="mb-3">
                    <strong>2. Sedang Disiapkan</strong>
                    <div class="text-muted">
                        Staff sedang mencari dan menyiapkan arsip.
                    </div>
                </div>

                <div class="mb-3">
                    <strong>3. Siap Diambil</strong>
                    <div class="text-muted">
                        Arsip telah tersedia dan siap diserahkan.
                    </div>
                </div>

                <div>
                    <strong>4. Diserahkan</strong>
                    <div class="text-muted">
                        Arsip telah diberikan kepada peminjam.
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Status Pengembalian</h3>
            </div>

            <div class="card-body text-center">
                <div class="display-4 mb-2">
                    {{ $returnedBorrowings }}
                </div>

                <div class="text-muted">
                    Arsip telah dikembalikan
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="card-title mb-1">Peminjaman Arsip</h3>
                <div class="text-muted">
                    Lihat dan proses pengajuan peminjaman yang telah disetujui.
                </div>
            </div>

            <a href="{{ route('staff.borrowings.index') }}"
               class="btn btn-primary">
                Kelola Peminjaman
            </a>
        </div>
    </div>
</div>

@endsection