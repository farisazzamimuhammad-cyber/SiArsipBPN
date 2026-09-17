@extends('layouts.app')

@section('title', 'Tambah Arsip')

@section('content')

<div class="page-header d-print-none mb-4">

    <div class="row align-items-center">

        <div class="col">

            <div class="page-pretitle text-primary">
                Manajemen Dokumen
            </div>

            <h2 class="page-title">
                Tambah Arsip
            </h2>

            <div class="text-secondary">
                Tambahkan dokumen baru ke dalam SIARSIP BPN.
            </div>

        </div>

        <div class="col-auto">

            <a href="{{ route('archives.index') }}"
               class="btn btn-outline-secondary">

                ← Kembali

            </a>

        </div>

    </div>

</div>


@if ($errors->any())

<div class="alert alert-danger">

    <div class="fw-bold mb-2">
        Terdapat kesalahan:
    </div>

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

        @endforeach

    </ul>

</div>

@endif


<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Informasi Arsip
                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('archives.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf


                    {{-- NOMOR BERKAS --}}

                    <div class="mb-3">

                        <label class="form-label required">
                            Nomor Berkas
                        </label>

                        <input type="text"
                               name="nomor_berkas"
                               class="form-control"
                               value="{{ old('nomor_berkas') }}"
                               placeholder="Contoh: ARS-001/2026"
                               required>

                    </div>


                    {{-- JUDUL --}}

                    <div class="mb-3">

                        <label class="form-label required">
                            Judul / Nama Dokumen
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control"
                               value="{{ old('judul') }}"
                               placeholder="Contoh: Surat Permohonan Sertifikat"
                               required>

                    </div>


                    {{-- JENIS ARSIP --}}

                    <div class="mb-3">

                        <label class="form-label required">
                            Jenis Arsip
                        </label>

                        <select name="jenis_arsip"
                                class="form-select"
                                required>

                            <option value="">
                                Pilih jenis arsip
                            </option>

                            <option value="Surat Masuk"
                                {{ old('jenis_arsip') == 'Surat Masuk' ? 'selected' : '' }}>

                                Surat Masuk

                            </option>

                            <option value="Surat Keluar"
                                {{ old('jenis_arsip') == 'Surat Keluar' ? 'selected' : '' }}>

                                Surat Keluar

                            </option>

                            <option value="Sertifikat"
                                {{ old('jenis_arsip') == 'Sertifikat' ? 'selected' : '' }}>

                                Sertifikat

                            </option>

                            <option value="Dokumen Pertanahan"
                                {{ old('jenis_arsip') == 'Dokumen Pertanahan' ? 'selected' : '' }}>

                                Dokumen Pertanahan

                            </option>

                            <option value="Akta"
                                {{ old('jenis_arsip') == 'Akta' ? 'selected' : '' }}>

                                Akta

                            </option>

                            <option value="Laporan"
                                {{ old('jenis_arsip') == 'Laporan' ? 'selected' : '' }}>

                                Laporan

                            </option>

                            <option value="Dokumen Administrasi"
                                {{ old('jenis_arsip') == 'Dokumen Administrasi' ? 'selected' : '' }}>

                                Dokumen Administrasi

                            </option>

                            <option value="Lainnya"
                                {{ old('jenis_arsip') == 'Lainnya' ? 'selected' : '' }}>

                                Lainnya

                            </option>

                        </select>

                    </div>


                    {{-- TANGGAL --}}

                    <div class="mb-3">

                        <label class="form-label required">
                            Tanggal Dokumen
                        </label>

                        <input type="date"
                               name="tanggal_dokumen"
                               class="form-control"
                               value="{{ old('tanggal_dokumen') }}"
                               required>

                    </div>


                    {{-- KETERANGAN --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea name="keterangan"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Tambahkan keterangan mengenai dokumen...">{{ old('keterangan') }}</textarea>

                    </div>


                    {{-- FILE --}}

                    <div class="mb-4">

                        <label class="form-label required">
                            Upload Berkas
                        </label>

                        <input type="file"
                               name="file"
                               class="form-control"
                               required>

                        <div class="form-hint mt-2">

                            Format yang diperbolehkan:
                            PDF, DOC, DOCX, JPG, JPEG, PNG, XLS, XLSX.

                            <br>

                            Maksimal ukuran file: 10 MB.

                        </div>

                    </div>


                    {{-- BUTTON --}}

                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('archives.index') }}"
                           class="btn btn-outline-secondary">

                            Batal

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            Simpan Arsip

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- INFORMATION CARD --}}

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Informasi
                </h3>

            </div>

            <div class="card-body">

                <div class="d-flex mb-3">

                    <span class="avatar bg-primary-lt me-3">
                        📁
                    </span>

                    <div>

                        <div class="fw-bold">
                            Arsip Digital
                        </div>

                        <div class="text-secondary">
                            Dokumen disimpan secara digital
                            dan terstruktur.
                        </div>

                    </div>

                </div>


                <div class="d-flex mb-3">

                    <span class="avatar bg-success-lt me-3">
                        🔒
                    </span>

                    <div>

                        <div class="fw-bold">
                            Keamanan
                        </div>

                        <div class="text-secondary">
                            File hanya dapat diakses
                            melalui sistem.
                        </div>

                    </div>

                </div>


                <div class="d-flex">

                    <span class="avatar bg-warning-lt me-3">
                        📄
                    </span>

                    <div>

                        <div class="fw-bold">
                            Format File
                        </div>

                        <div class="text-secondary">
                            PDF, Word, Excel dan gambar.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection