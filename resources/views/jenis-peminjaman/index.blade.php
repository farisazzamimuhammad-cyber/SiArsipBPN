@extends('layouts.app')

@section('title', 'Jenis Peminjaman')

@section('content')

<div class="page-header mb-3">

    <div>
        <div class="page-pretitle">
            Master Data
        </div>

        <h2 class="page-title">
            Jenis Peminjaman
        </h2>
    </div>

</div>


<div class="alert alert-info">

    <div class="d-flex">

        <div>
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="icon alert-icon">

                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>

                <path d="M10.24 3.75l-8.47 14a2 2 0 0 0 1.71 3h17.04a2 2 0 0 0 1.71-3l-8.47-14a2 2 0 0 0-3.52 0z"></path>

            </svg>
        </div>

        <div>
            Jenis peminjaman merupakan data tetap dan tidak dapat
            ditambah, diubah, atau dihapus melalui sistem.
        </div>

    </div>

</div>


<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Daftar Jenis Peminjaman
        </h3>

    </div>


    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-vcenter card-table">

                <thead>

                    <tr>

                        <th width="80">
                            No
                        </th>

                        <th>
                            Kode
                        </th>

                        <th>
                            Jenis Peminjaman
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($jenisPeminjaman as $kode => $nama)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="badge bg-blue-lt">
                                    {{ $kode }}
                                </span>
                            </td>

                            <td>
                                {{ $nama }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection