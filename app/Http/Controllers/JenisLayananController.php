<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisLayananController extends Controller
{
    /**
     * Menampilkan data jenis layanan
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = JenisLayanan::query();

            return DataTables::of($data)

                ->addIndexColumn()

                ->editColumn('jangka_peminjaman', function ($item) {
                    return $item->jangka_peminjaman . ' hari';
                })

                ->addColumn('action', function ($item) {

                    return '
                        <div class="btn-list flex-nowrap">

                            <a href="' . route(
                                'jenis-layanan.edit',
                                $item->id
                            ) . '"
                            class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form action="' . route(
                                'jenis-layanan.destroy',
                                $item->id
                            ) . '"
                            method="POST"
                            onsubmit="return confirm(\'Yakin ingin menghapus jenis layanan ini?\')">

                                ' . csrf_field() . '

                                ' . method_field('DELETE') . '

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>

                            </form>

                        </div>
                    ';
                })

                ->rawColumns([
                    'action',
                ])

                ->make(true);
        }

        $totalLayanan = JenisLayanan::count();

        return view(
            'jenis-layanan.index',
            compact('totalLayanan')
        );
    }


    /**
     * Form tambah
     */
    public function create()
    {
        return view('jenis-layanan.create');
    }


    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:50|unique:jenis_layanans,kode',

            'nama' => 'required|string|max:150',

            'jangka_peminjaman' => 'required|integer|min:1',
        ]);

        JenisLayanan::create([
            'kode' => $request->kode,

            'nama' => $request->nama,

            'jangka_peminjaman' => $request->jangka_peminjaman,
        ]);

        return redirect()
            ->route('jenis-layanan.index')
            ->with(
                'success',
                'Jenis layanan berhasil ditambahkan.'
            );
    }


    /**
     * Form edit
     */
    public function edit(JenisLayanan $jenisLayanan)
    {
        return view(
            'jenis-layanan.edit',
            compact('jenisLayanan')
        );
    }


    /**
     * Update data
     */
    public function update(
        Request $request,
        JenisLayanan $jenisLayanan
    ) {
        $request->validate([
            'kode' => 'required|string|max:50|unique:jenis_layanans,kode,' . $jenisLayanan->id,

            'nama' => 'required|string|max:150',

            'jangka_peminjaman' => 'required|integer|min:1',
        ]);

        $jenisLayanan->update([
            'kode' => $request->kode,

            'nama' => $request->nama,

            'jangka_peminjaman' => $request->jangka_peminjaman,
        ]);

        return redirect()
            ->route('jenis-layanan.index')
            ->with(
                'success',
                'Jenis layanan berhasil diperbarui.'
            );
    }


    /**
     * Hapus data
     */
    public function destroy(JenisLayanan $jenisLayanan)
    {
        $jenisLayanan->delete();

        return redirect()
            ->route('jenis-layanan.index')
            ->with(
                'success',
                'Jenis layanan berhasil dihapus.'
            );
    }
}