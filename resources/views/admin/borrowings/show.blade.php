@extends('layouts.app')

@section('content')

<div class="container-xl">

    <div class="mb-4">
        <a
            href="{{ route('admin.borrowings.index') }}"
            class="btn btn-secondary mb-3"
        >
            Kembali
        </a>

        <h1 class="h2">Detail Pengajuan Peminjaman</h1>
    </div>

    <div class="row row-cards">

        {{-- Informasi Pemohon --}}
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


        {{-- Informasi Arsip --}}
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


        {{-- Detail Pengajuan --}}
        <div class="col-12">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Detail Peminjaman
                    </h3>
                </div>

                <div class="card-body">

                    <dl class="row">

                        <dt class="col-md-3">
                            Tanggal Pengajuan
                        </dt>

                        <dd class="col-md-9">
                            {{ $borrowing->tanggal_pengajuan?->format('d/m/Y') ?? '-' }}
                        </dd>

                        <dt class="col-md-3">
                            Tanggal Peminjaman
                        </dt>

                        <dd class="col-md-9">
                            {{ $borrowing->tanggal_peminjaman?->format('d/m/Y') ?? '-' }}
                        </dd>

                        <dt class="col-md-3">
                            Keperluan
                        </dt>

                        <dd class="col-md-9">
                            {{ $borrowing->keperluan }}
                        </dd>

                        <dt class="col-md-3">
                            Status
                        </dt>

                        <dd class="col-md-9">

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

                            @endif

                        </dd>

                    </dl>

                </div>


                {{-- Approval --}}
                @if($borrowing->status === 'pending')

                    <div class="card-footer">

                        <div class="d-flex gap-2">

                            @can('borrowings.approve')

                                <form
                                    action="{{ route('admin.borrowings.approve', $borrowing) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-success"
                                        onclick="return confirm('Setujui pengajuan ini?')"
                                    >
                                        Setujui Peminjaman
                                    </button>

                                </form>

                            @endcan


                            @can('borrowings.reject')

                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalReject"
                                >
                                    Tolak Peminjaman
                                </button>

                            @endcan

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- Modal Tolak --}}

<div
    class="modal modal-blur fade"
    id="modalReject"
    tabindex="-1"
    role="dialog"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                action="{{ route('admin.borrowings.reject', $borrowing) }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tolak Peminjaman
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body">

                    <label class="form-label required">
                        Alasan Penolakan
                    </label>

                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan alasan penolakan..."
                        required
                    ></textarea>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Tolak Peminjaman
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection