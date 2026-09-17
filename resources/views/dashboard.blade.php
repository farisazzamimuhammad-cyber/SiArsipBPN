@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="page-header d-print-none mb-4">

    <div class="row align-items-center">

        <div class="col">

            <div class="page-pretitle text-primary">
                SIARSIP BPN
            </div>

            <h2 class="page-title">
                Dashboard
            </h2>

            <div class="text-secondary mt-1">
                Selamat datang kembali di Sistem Informasi Arsip BPN.
            </div>

        </div>

        <div class="col-auto">

            <div class="text-secondary">
                {{ now()->format('d F Y') }}
            </div>

        </div>

    </div>

</div>


{{-- WELCOME CARD --}}
<div class="card bg-primary text-white mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col">

                <div class="h1 mb-2 text-white">
                    Selamat Datang!
                </div>

                <div class="fs-3">
                    di SIARSIP BPN
                </div>

                <div class="mt-2 opacity-75">
                    Kelola data dan informasi arsip dengan lebih mudah,
                    cepat, dan terstruktur.
                </div>

            </div>

            <div class="col-auto">

                <div style="font-size: 70px;">
                    📁
                </div>

            </div>

        </div>

    </div>

</div>


{{-- STATISTICS --}}
<div class="row row-deck row-cards mb-4">


    {{-- USERS --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-primary-lt me-3">

                        👥

                    </span>

                    <div class="text-secondary">
    Total Users
</div>

<div class="h2 mb-0">
    0
</div>

                </div>

                <div class="mt-3">

                    <span class="text-success">
                        ●
                    </span>

                    Pengguna terdaftar

                </div>

            </div>

        </div>

    </div>


    {{-- ARSIP --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-success-lt me-3">

                        📂

                    </span>

                    <div>

                        <div class="text-secondary">
                            Total Arsip
                        </div>

                        <div class="h2 mb-0">
                            0
                        </div>

                    </div>

                </div>

                <div class="mt-3 text-secondary">
                    Belum ada data arsip
                </div>

            </div>

        </div>

    </div>


    {{-- ARSIP MASUK --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-warning-lt me-3">

                        📥

                    </span>

                    <div>

                        <div class="text-secondary">
                            Arsip Masuk
                        </div>

                        <div class="h2 mb-0">
                            0
                        </div>

                    </div>

                </div>

                <div class="mt-3 text-secondary">
                    Dokumen masuk
                </div>

            </div>

        </div>

    </div>


    {{-- ARSIP KELUAR --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-info-lt me-3">

                        📤

                    </span>

                    <div>

                        <div class="text-secondary">
                            Arsip Keluar
                        </div>

                        <div class="h2 mb-0">
                            0
                        </div>

                    </div>

                </div>

                <div class="mt-3 text-secondary">
                    Dokumen keluar
                </div>

            </div>

        </div>

    </div>

</div>


{{-- CONTENT --}}
<div class="row row-deck row-cards">


    {{-- AKTIVITAS --}}
    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Aktivitas Terbaru
                </h3>

            </div>

            <div class="list-group list-group-flush">

                <div class="list-group-item">

                    <div class="row align-items-center">

                        <div class="col-auto">

                            <span class="avatar bg-primary-lt">
                                👤
                            </span>

                        </div>

                        <div class="col">

                            <div>
                                Sistem siap digunakan
                            </div>

                            <div class="text-secondary">
                                Dashboard SIARSIP BPN berhasil dimuat.
                            </div>

                        </div>

                        <div class="col-auto text-secondary">
                            Sekarang
                        </div>

                    </div>

                </div>


                <div class="list-group-item">

                    <div class="row align-items-center">

                        <div class="col-auto">

                            <span class="avatar bg-success-lt">
                                🔐
                            </span>

                        </div>

                        <div class="col">

                            <div>
                                Authentication aktif
                            </div>

                            <div class="text-secondary">
                                Sistem login berhasil diaktifkan.
                            </div>

                        </div>

                        <div class="col-auto text-secondary">
                            Hari ini
                        </div>

                    </div>

                </div>


                <div class="list-group-item">

                    <div class="row align-items-center">

                        <div class="col-auto">

                            <span class="avatar bg-warning-lt">
                                ⚙️
                            </span>

                        </div>

                        <div class="col">

                            <div>
                                Sistem diperbarui
                            </div>

                            <div class="text-secondary">
                                Modul Users dan DataTables tersedia.
                            </div>

                        </div>

                        <div class="col-auto text-secondary">
                            Hari ini
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SYSTEM STATUS --}}
    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Status Sistem
                </h3>

            </div>

            <div class="card-body">


                <div class="d-flex align-items-center mb-4">

                    <span class="status-dot status-dot-animated bg-success me-2">
                    </span>

                    <strong>
                        Sistem Aktif
                    </strong>

                </div>


                <div class="mb-3">

    <div class="d-flex justify-content-between">

        <span class="text-secondary">
            Users
        </span>

        <span>
            {{ \App\Models\User::count() }}
        </span>

    </div>

</div>


                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <span class="text-secondary">
                            Database
                        </span>

                        <span class="text-success">
                            Connected
                        </span>

                    </div>

                </div>


                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <span class="text-secondary">
                            Authentication
                        </span>

                        <span class="text-success">
                            Active
                        </span>

                    </div>

                </div>


                <div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-secondary">
                            Sistem
                        </span>

                        <span>
                            100%
                        </span>

                    </div>

                    <div class="progress">

                        <div class="progress-bar"
                             style="width: 100%"
                             role="progressbar">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection