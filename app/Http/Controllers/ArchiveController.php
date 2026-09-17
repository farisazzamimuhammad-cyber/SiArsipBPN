<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $archives = Archive::with('user')
                ->select('archives.*');

            return DataTables::of($archives)

                ->addIndexColumn()

                ->addColumn('uploader', function ($archive) {

                    return $archive->user
                        ? $archive->user->name
                        : '-';

                })

                ->editColumn('tanggal_dokumen', function ($archive) {

                    return $archive->tanggal_dokumen
                        ? $archive->tanggal_dokumen->format('d M Y')
                        : '-';

                })

                ->addColumn('file', function ($archive) {

                    return '
                        <div class="d-flex align-items-center">

                            <span class="avatar avatar-sm bg-red-lt me-2">
                                PDF
                            </span>

                            <div>
                                <div class="font-weight-medium">
                                    ' . e($archive->nama_file) . '
                                </div>

                                <div class="text-secondary small">
                                    ' . e($archive->mime_type ?? 'File') . '
                                </div>
                            </div>

                        </div>
                    ';

                })

                ->addColumn('type_badge', function ($archive) {

                    return '
                        <span class="badge bg-blue-lt">
                            ' . e($archive->jenis_arsip) . '
                        </span>
                    ';

                })

                ->addColumn('action', function ($archive) {

                    return '
                        <div class="btn-list flex-nowrap">

                            <a href="#"
                               class="btn btn-sm btn-outline-primary">
                                Lihat
                            </a>

                            <a href="#"
                               class="btn btn-sm btn-outline-secondary">
                                Edit
                            </a>

                        </div>
                    ';

                })

                ->rawColumns([
                    'file',
                    'type_badge',
                    'action'
                ])

                ->make(true);
        }

        $totalArchives = Archive::count();

        return view('archives.index', compact('totalArchives'));
    }

    public function create()
{
    return view('archives.create');
}

public function store(Request $request)
{
    $request->validate([
        'nomor_berkas' => 'required|string|max:255|unique:archives,nomor_berkas',
        'judul' => 'required|string|max:255',
        'jenis_arsip' => 'required|string|max:100',
        'tanggal_dokumen' => 'required|date',
        'keterangan' => 'nullable|string',
        'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,xls,xlsx|max:10240',
    ]);

    $file = $request->file('file');

    $namaFile = $file->getClientOriginalName();

    $path = $file->store('archives', 'public');

    Archive::create([
        'user_id' => Auth::id(),
        'nomor_berkas' => $request->nomor_berkas,
        'judul' => $request->judul,
        'jenis_arsip' => $request->jenis_arsip,
        'tanggal_dokumen' => $request->tanggal_dokumen,
        'keterangan' => $request->keterangan,
        'nama_file' => $namaFile,
        'path_file' => $path,
        'mime_type' => $file->getMimeType(),
        'ukuran_file' => $file->getSize(),
    ]);

    return redirect()
        ->route('archives.index')
        ->with('success', 'Arsip berhasil ditambahkan.');
}
}