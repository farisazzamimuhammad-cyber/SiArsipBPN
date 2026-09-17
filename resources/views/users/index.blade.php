@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

<div class="page-header mb-3">
    <div>
        <div class="page-pretitle">
            Manajemen Pengguna
        </div>

        <h2 class="page-title">
            Pengguna
        </h2>
    </div>

    <div class="page-header-actions">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
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

            Tambah Pengguna
        </a>
    </div>
</div>


{{-- Statistik --}}
<div class="row row-deck row-cards mb-3">

    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="subheader">
                        Total Pengguna
                    </div>

                </div>

                <div class="h1 mb-0">
                    {{ $totalUsers }}
                </div>

            </div>
        </div>
    </div>

</div>


{{-- Tabel --}}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Data Pengguna
        </h3>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table
                id="users-table"
                class="table table-vcenter card-table"
                style="width:100%"
            >

                <thead>
                    <tr>
                        <th width="50">No</th>

                        <th>Pengguna</th>

                        <th>Jabatan</th>

                        <th>Role</th>

                        <th>Tanggal Dibuat</th>

                        <th width="150">Aksi</th>
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

    $('#users-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('users.index') }}",

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'user',
                name: 'name',
                orderable: true,
                searchable: true
            },

            {
                data: 'jabatan',
                name: 'jabatan.nama',
                orderable: false,
                searchable: false
            },

            {
                data: 'role_badge',
                name: 'roles.name',
                orderable: false,
                searchable: false
            },

            {
                data: 'created_at',
                name: 'created_at',
                searchable: false
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ],

        order: [
            [4, 'desc']
        ],

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        language: {
            search: "Cari:",
            searchPlaceholder: "Cari pengguna...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Data tidak ditemukan",
            processing: "Memproses...",
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