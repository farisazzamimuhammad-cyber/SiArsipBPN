<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Menampilkan halaman Users dan DataTables
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $users = User::query()
                ->with(['roles', 'jabatan'])
                ->select([
                    'id',
                    'name',
                    'email',
                    'jabatan_id',
                    'created_at',
                ]);

            return DataTables::of($users)

                ->addIndexColumn()

                ->addColumn('user', function ($user) {

                    $initial = strtoupper(
                        substr($user->name, 0, 1)
                    );

                    return '
                        <div class="d-flex align-items-center">
                            <span class="avatar me-3">
                                ' . e($initial) . '
                            </span>

                            <div>
                                <div class="font-weight-medium">
                                    ' . e($user->name) . '
                                </div>

                                <div class="text-secondary">
                                    ' . e($user->email) . '
                                </div>
                            </div>
                        </div>
                    ';
                })

                ->addColumn('jabatan', function ($user) {

                    if (!$user->jabatan) {
                        return '
                            <span class="text-secondary">
                                Belum ada jabatan
                            </span>
                        ';
                    }

                    return e($user->jabatan->nama);
                })

                ->addColumn('role_badge', function ($user) {

                    $role = $user->roles->first();

                    if (!$role) {
                        return '
                            <span class="badge bg-secondary-lt">
                                Belum ada role
                            </span>
                        ';
                    }

                    $class = match ($role->name) {
                        'Admin' => 'bg-blue-lt',
                        'Staff' => 'bg-green-lt',
                        'User' => 'bg-secondary-lt',
                        default => 'bg-secondary-lt',
                    };

                    return '
                        <span class="badge ' . $class . '">
                            ' . e($role->display_name ?? $role->name) . '
                        </span>
                    ';
                })

                ->editColumn('created_at', function ($user) {

                    return $user->created_at
                        ? $user->created_at->format('d M Y')
                        : '-';
                })

                ->addColumn('action', function ($user) {

                    return '
                        <div class="btn-list flex-nowrap">

                            <a href="' . route('users.edit', $user->id) . '"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form action="' . route('users.destroy', $user->id) . '"
                                  method="POST"
                                  onsubmit="return confirm(\'Yakin ingin menghapus user ini?\')">

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
                    'user',
                    'jabatan',
                    'role_badge',
                    'action',
                ])

                ->make(true);
        }

        $totalUsers = User::count();

        return view('users.index', compact('totalUsers'));
    }


    /**
     * Form tambah user
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        $jabatans = Jabatan::orderBy('kelompok')
            ->orderBy('nama')
            ->get();

        return view('users.create', compact(
            'roles',
            'jabatans'
        ));
    }


    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email',

            'jabatan_id' => 'required|exists:jabatans,id',

            'role' => 'required|exists:roles,name',

            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,

            'email' => $request->email,

            'jabatan_id' => $request->jabatan_id,

            'password' => Hash::make($request->password),
        ]);

        $role = Role::where(
            'name',
            $request->role
        )->first();

        $user->syncRoles([$role]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }


    /**
     * Form edit user
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        $jabatans = Jabatan::orderBy('kelompok')
            ->orderBy('nama')
            ->get();

        $currentRole = $user->roles->first();

        return view(
            'users.edit',
            compact(
                'user',
                'roles',
                'jabatans',
                'currentRole'
            )
        );
    }


    /**
     * Update user
     */
    public function update(
        Request $request,
        User $user
    ) {
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email,' . $user->id,

            'jabatan_id' => 'required|exists:jabatans,id',

            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'name' => $request->name,

            'email' => $request->email,

            'jabatan_id' => $request->jabatan_id,
        ];

        /*
         * Jika password diisi,
         * maka password akan diperbarui.
         */
        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:8|confirmed',
            ]);

            $data['password'] = Hash::make(
                $request->password
            );
        }

        $user->update($data);

        $role = Role::where(
            'name',
            $request->role
        )->first();

        $user->syncRoles([$role]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }


    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }
}