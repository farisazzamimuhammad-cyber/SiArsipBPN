@extends('layouts.app')

@section('title', 'Jenis Layanan')

@section('content')

<div class="page-header mb-3">

    <div>
        <div class="page-pretitle">
            Master Data
        </div>

        <h2 class="page-title">
            Jenis Layanan
        </h2>
    </div>

    <div class="page-header-actions">

        <a href="{{ route('jenis-layanan.create') }}"
           class="btn btn-primary">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="icon">

                <path d="M12 5v14"></path>
                <path d="M5 12h14"></path>

            </svg>

            Tambah Jenis Layanan

        </a>

    </div>

</div>


@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif


<div class="row row-deck row-cards mb-3">

    <div class="col-sm-6 col-lg-3">

        <div class="card">

            <div class="card-body">

                <div class="subheader">
                    Total Jenis Layanan
                </div>

                <div class="h1 mb-0">
                    {{ $totalLayanan }}
                </div>

            </div>

        </div>

    </div>

</div>


<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Data Jenis Layanan
        </h3>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table
                id="jenis-layanan-table"
                class="table table-vcenter card-table"
                style="width:100%"
            >

                <thead>

                    <tr>

                        <th width="50">
                            No
                        </th>

                        <th>
                            Kode
                        </th>

                        <th>
                            Jenis Layanan
                        </th>

                        <th>
                            Jangka Peminjaman
                        </th>

                        <th width="150">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>
                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

$(document).ready(function () {

    $('#jenis-layanan-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('jenis-layanan.index') }}",

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'kode',
                name: 'kode'
            },

            {
                data: 'nama',
                name: 'nama'
            },

            {
                data: 'jangka_peminjaman',
                name: 'jangka_peminjaman'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ],

        order: [
            [1, 'asc']
        ],

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        language: {

            search: "Cari:",

            searchPlaceholder:
                "Cari jenis layanan...",

            lengthMenu:
                "Tampilkan _MENU_ data",

            info:
                "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty:
                "Tidak ada data",

            zeroRecords:
                "Data tidak ditemukan",

            processing:
                "Memproses...",

            paginate: {

                first: "Pertama",

                last: "Terakhir",

                next: "Berikutnya",

                previous: "Sebelumnya"

            }

        }

    });

});

</script>

@endpush