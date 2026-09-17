@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="mb-4">
        <h1 class="h2">Pengajuan Peminjaman</h1>

        <p class="text-secondary mb-0">
            Kelola pengajuan peminjaman arsip dari pengguna.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Daftar Pengajuan
            </h3>
        </div>

        <div class="table-responsive">

            <table class="table table-vcenter card-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>Arsip</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th class="w-1">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($borrowings as $borrowing)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $borrowing->user->name ?? '-' }}
                                </strong>

                                <div class="text-secondary">
                                    {{ $borrowing->user->email ?? '-' }}
                                </div>
                            </td>

                            <td>

                                <strong>
                                    {{ $borrowing->archive->judul ?? '-' }}
                                </strong>

                                <div class="text-secondary">
                                    {{ $borrowing->archive->nomor_berkas ?? '-' }}
                                </div>

                            </td>

                            <td>
                                {{ $borrowing->tanggal_pengajuan?->format('d/m/Y') ?? '-' }}
                            </td>

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

                                @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($borrowing->status) }}
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.borrowings.show', $borrowing) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
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