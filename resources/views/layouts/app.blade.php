<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIARSIP BPN')</title>

    {{-- Tabler --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css"
    >

    {{-- DataTables --}}
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css"
    >

</head>


<body>

<div class="page">


    {{-- SIDEBAR --}}
    <aside class="navbar navbar-vertical navbar-expand-lg">

        <div class="container-fluid">

            {{-- Logo --}}
            <h1 class="navbar-brand">
                SIARSIP BPN
            </h1>


            <div class="collapse navbar-collapse show">

                <ul class="navbar-nav">


                    {{-- ================================================= --}}
                    {{-- DASHBOARD --}}
                    {{-- ================================================= --}}

                    <li class="nav-item">

                        @auth

                            @if(auth()->user()->hasRole('Admin'))

                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Dashboard
                                    </span>
                                </a>

                            @elseif(auth()->user()->hasRole('Staff'))

                                <a
                                    href="{{ route('staff.dashboard') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Dashboard
                                    </span>
                                </a>

                            @elseif(auth()->user()->hasRole('User'))

                                <a
                                    href="{{ route('user.dashboard') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Dashboard
                                    </span>
                                </a>

                            @endif

                        @endauth

                    </li>


                    {{-- ================================================= --}}
                    {{-- MENU ADMIN / PIMPINAN --}}
                    {{-- ================================================= --}}

                    @role('Admin')

                        {{-- Pengajuan Peminjaman --}}
                        @can('borrowings.view')

                            <li class="nav-item">

                                <a
                                    href="{{ route('admin.borrowings.index') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Pengajuan Peminjaman
                                    </span>
                                </a>

                            </li>

                        @endcan


                        {{-- Arsip --}}
                        @can('archives.view')

                            <li class="nav-item">

                                <a
                                    href="{{ route('archives.index') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Arsip
                                    </span>
                                </a>

                            </li>

                        @endcan


                        {{-- Users --}}
                        @can('users.view')

                            <li class="nav-item">

                                <a
                                    href="{{ route('users.index') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Pengguna
                                    </span>
                                </a>

                            </li>

                        @endcan

                    @endrole


                    {{-- ================================================= --}}
                    {{-- MENU STAFF --}}
                    {{-- ================================================= --}}

                    @role('Staff')

                        {{-- Peminjaman --}}
                        @can('borrowings.view')

                            <li class="nav-item">

                                <a
                                    href="{{ route('staff.borrowings.index') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Peminjaman Arsip
                                    </span>
                                </a>

                            </li>

                        @endcan


                        {{-- Arsip --}}
                        @can('archives.view')

                            <li class="nav-item">

                                <a
                                    href="{{ route('archives.index') }}"
                                    class="nav-link"
                                >
                                    <span class="nav-link-title">
                                        Arsip
                                    </span>
                                </a>

                            </li>

                        @endcan

                    @endrole


                    {{-- ================================================= --}}
                    {{-- MENU USER --}}
                    {{-- ================================================= --}}

                    @role('User')

                        {{-- Tidak ada menu Arsip / Users --}}
                        {{-- User hanya menggunakan Dashboard --}}

                    @endrole


                    {{-- ================================================= --}}
                    {{-- AKUN SAYA --}}
                    {{-- ================================================= --}}

                    @auth

                        <li class="nav-item mt-3">

    <a
        href="{{ route('profile.index') }}"
        class="nav-link"
    >
        <span class="nav-link-title">
            Akun Saya
        </span>
    </a>

</li>


                        {{-- LOGOUT --}}

                        <li class="nav-item">

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="nav-link border-0 bg-transparent w-100 text-start"
                                >

                                    <span class="nav-link-title">
                                        Logout
                                    </span>

                                </button>

                            </form>

                        </li>

                    @endauth


                </ul>

            </div>

        </div>

    </aside>


    {{-- ================================================= --}}
    {{-- CONTENT --}}
    {{-- ================================================= --}}

    <div class="page-wrapper">

        <div class="page-body">

            <div class="container-xl">

                @yield('content')

            </div>

        </div>

    </div>

</div>


{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

{{-- Tabler --}}
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js"></script>

@stack('scripts')

</body>

</html>