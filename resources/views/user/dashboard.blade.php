@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="mb-4">
        <h1 class="h2">Dashboard Peminjaman</h1>

        <p class="text-secondary">
            Selamat datang, {{ auth()->user()->name }}
        </p>
    </div>

    <div class="row row-cards">

        {{-- Ajukan Peminjaman --}}
        <div class="col-md-6 col-lg-4">

            <div class="card">

                <div class="card-body">

                    <div class="mb-3">
                        <span class="avatar avatar-lg rounded bg-primary-lt">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z"/>
                                <path d="M9 12h6"/>
                                <path d="M12 9v6"/>
                            </svg>
                        </span>
                    </div>

                    <h3>Ajukan Peminjaman</h3>

                    <p class="text-secondary">
                        Ajukan permintaan untuk meminjam arsip yang tersedia.
                    </p>

                    @can('borrowings.create')

                        <a
                            href="{{ route('user.borrowings.create') }}"
                            class="btn btn-primary"
                        >
                            Ajukan Sekarang
                        </a>

                    @endcan

                </div>

            </div>

        </div>


        {{-- Riwayat --}}
        <div class="col-md-6 col-lg-4">

            <div class="card">

                <div class="card-body">

                    <div class="mb-3">
                        <span class="avatar avatar-lg rounded bg-success-lt">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                <path d="M12 7v5l3 3"/>
                            </svg>
                        </span>
                    </div>

                    <h3>Riwayat Peminjaman</h3>

                    <p class="text-secondary">
                        Lihat status dan riwayat pengajuan peminjaman arsip.
                    </p>

                    @can('borrowings.view')

                        <a
                            href="{{ route('user.borrowings.index') }}"
                            class="btn btn-success"
                        >
                            Lihat Riwayat
                        </a>

                    @endcan

                </div>

            </div>

        </div>

    </div>

</div>

@endsection