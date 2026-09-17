@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="mb-4">
        <h1 class="h2">Peminjaman Arsip</h1>

        <p class="text-secondary mb-0">
            Kelola arsip yang telah disetujui untuk dipersiapkan.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Daftar Peminjaman
            </h3>
        </div>

        <div class="table-responsive">

            <table class="table table-vcenter card-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>Arsip</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                                {{ $borrowing->tanggal_peminjaman?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td>

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
                                @elseif($borrowing->status === 'borrowed')

    <span class="badge bg-purple">
        Sedang Dipinjam
    </span>

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('staff.borrowings.show', $borrowing) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                Tidak ada arsip yang perlu diproses.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection