@extends('layouts.app')

@section('title', 'Arsip Berkas')

@section('content')

<div class="page-header d-print-none mb-4">

    <div class="row align-items-center">

        <div class="col">

            <div class="page-pretitle text-primary">
                DOCUMENT MANAGEMENT
            </div>

            <h2 class="page-title">
                Arsip Berkas
            </h2>

            <div class="text-secondary">
                Kelola seluruh dokumen dan berkas SIARSIP BPN.
            </div>

        </div>

        <div class="col-auto ms-auto">

            <a href="{{ route('archives.create') }}"
               class="btn btn-primary">

                + Tambah Arsip

            </a>

        </div>

    </div>

</div>


{{-- STATISTIC --}}

<div class="row row-cards mb-4">

    <div class="col-sm-6 col-lg-4">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-primary-lt me-3">
                        📁
                    </span>

                    <div>

                        <div class="text-secondary">
                            Total Arsip
                        </div>

                        <div class="h2 mb-0">
                            {{ $totalArchives }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- TABLE --}}

<div class="card">

    <div class="card-header">

        <div>

            <h3 class="card-title">
                Daftar Arsip
            </h3>

            <div class="text-secondary">
                Seluruh dokumen yang tersimpan dalam sistem.
            </div>

        </div>

    </div>


    <div class="table-responsive">

        <table id="archives-table"
               class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th width="50">
                        #
                    </th>

                    <th>
                        Berkas
                    </th>

                    <th>
                        Jenis
                    </th>

                    <th>
                        Tanggal
                    </th>

                    <th>
                        Diunggah Oleh
                    </th>

                    <th>
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>
            </tbody>

        </table>

    </div>

</div>

@endsection


@push('scripts')

<script>

$(document).ready(function () {

    $('#archives-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('archives.index') }}",

        pageLength: 10,

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'file',
                name: 'nama_file'
            },

            {
                data: 'type_badge',
                name: 'jenis_arsip'
            },

            {
                data: 'tanggal_dokumen',
                name: 'tanggal_dokumen'
            },

            {
                data: 'uploader',
                name: 'user.name'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ],

        order: [
            [3, 'desc']
        ]

    });

});

</script>

@endpush