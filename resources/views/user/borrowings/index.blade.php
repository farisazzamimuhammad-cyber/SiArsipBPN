@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h2">Peminjaman Arsip</h1>

            <p class="text-secondary mb-0">
                Daftar pengajuan peminjaman arsip Anda.
            </p>
        </div>

        @can('borrowings.create')

            <a
                href="{{ route('user.borrowings.create') }}"
                class="btn btn-primary"
            >
                Ajukan Peminjaman
            </a>

        @endcan

    </div>


    {{-- Pesan berhasil --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Pesan error --}}
    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                Riwayat Peminjaman
            </h3>

        </div>


        <div class="table-responsive">

            <table class="table table-vcenter card-table">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nomor Berkas</th>

                        <th>Judul Arsip</th>

                        <th>Tanggal Pengajuan</th>

                        <th>Tanggal Peminjaman</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($borrowings as $borrowing)

                        <tr>

                            {{-- No --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- Nomor Berkas --}}
                            <td>
                                {{ $borrowing->archive->nomor_berkas ?? '-' }}
                            </td>


                            {{-- Judul Arsip --}}
                            <td>
                                {{ $borrowing->archive->judul ?? '-' }}
                            </td>


                            {{-- Tanggal Pengajuan --}}
                            <td>
                                {{ $borrowing->tanggal_pengajuan?->format('d/m/Y') ?? '-' }}
                            </td>


                            {{-- Tanggal Peminjaman --}}
                            <td>
                                {{ $borrowing->tanggal_peminjaman?->format('d/m/Y') ?? '-' }}
                            </td>


                            {{-- Status --}}
                            <td>

                                @if($borrowing->status === 'pending')

                                    <span class="badge bg-warning text-dark">
                                        Menunggu Persetujuan
                                    </span>

                                @elseif($borrowing->status === 'approved')

                                    <span class="badge bg-success">
                                        Disetujui
                                    </span>

                                @elseif($borrowing->status === 'rejected')

                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>

                                @elseif($borrowing->status === 'preparing')

                                    <span class="badge bg-info">
                                        Sedang Disiapkan
                                    </span>

                                @elseif($borrowing->status === 'ready')

                                    <span class="badge bg-primary">
                                        Siap Diambil
                                    </span>

                                @elseif($borrowing->status === 'borrowed')

                                    <span class="badge bg-purple">
                                        Sedang Dipinjam
                                    </span>

                                @elseif($borrowing->status === 'returned')

                                    <span class="badge bg-secondary">
                                        Dikembalikan
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($borrowing->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                @if($borrowing->status === 'borrowed')

                                    @can('borrowings.cancel')

                                        <form
                                            action="{{ route('user.borrowings.return', $borrowing) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-warning"
                                                onclick="return confirm('Apakah Anda yakin ingin mengembalikan arsip ini?')"
                                            >
                                                Kembalikan Arsip
                                            </button>

                                        </form>

                                    @endcan


                                @elseif($borrowing->status === 'returned')

                                    <span class="text-secondary">
                                        Dikembalikan pada
                                        {{ $borrowing->tanggal_pengembalian?->format('d/m/Y') ?? '-' }}
                                    </span>


                                @else

                                    <span class="text-secondary">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center text-secondary py-5"
                            >
                                Belum ada pengajuan peminjaman.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection