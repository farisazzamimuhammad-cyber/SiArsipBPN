<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AdminBorrowingController;
use App\Http\Controllers\StaffBorrowingController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\JenisPeminjamanController;

Route::get(
    '/borrowings/{borrowing}',
    [BorrowingController::class, 'show']
)->name('user.borrowings.show');
/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    // Jika belum login, arahkan ke login
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Jika sudah login, cek role
    $user = auth()->user();

    if ($user->hasRole('Admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('Staff')) {
        return redirect()->route('staff.dashboard');
    }

    if ($user->hasRole('User')) {
        return redirect()->route('user.dashboard');
    }

    abort(403);

})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::resource(
    'jenis-layanan',
    JenisLayananController::class
)->except([
    'show',
]);


Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
Route::post('/user/borrowings/{borrowing}/return', [BorrowingController::class, 'returnArchive'])
    ->middleware('permission:borrowings.cancel')
    ->name('user.borrowings.return');

/*
|--------------------------------------------------------------------------
| Profile / Akun Saya
|--------------------------------------------------------------------------
*/

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index');

Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::put('/profile/password', [ProfileController::class, 'password'])
    ->name('profile.password');

    
    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Dashboard Berdasarkan Role
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:Admin')
        ->name('admin.dashboard');

    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])
        ->middleware('role:Staff')
        ->name('staff.dashboard');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('role:User')
        ->name('user.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Admin - Peminjaman
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin')->group(function () {

        Route::get('/admin/borrowings', [AdminBorrowingController::class, 'index'])
            ->middleware('permission:borrowings.view')
            ->name('admin.borrowings.index');

        Route::get('/admin/borrowings/{borrowing}', [AdminBorrowingController::class, 'show'])
            ->middleware('permission:borrowings.view')
            ->name('admin.borrowings.show');

        Route::post('/admin/borrowings/{borrowing}/approve', [AdminBorrowingController::class, 'approve'])
            ->middleware('permission:borrowings.approve')
            ->name('admin.borrowings.approve');

        Route::post('/admin/borrowings/{borrowing}/reject', [AdminBorrowingController::class, 'reject'])
            ->middleware('permission:borrowings.reject')
            ->name('admin.borrowings.reject');

    });


    /*
    |--------------------------------------------------------------------------
    | User - Peminjaman
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:borrowings.view')->group(function () {

        Route::get('/user/borrowings', [BorrowingController::class, 'index'])
            ->name('user.borrowings.index');

    });

    Route::middleware('permission:borrowings.create')->group(function () {

        Route::get('/user/borrowings/create', [BorrowingController::class, 'create'])
            ->name('user.borrowings.create');

        Route::post('/user/borrowings', [BorrowingController::class, 'store'])
            ->name('user.borrowings.store');

    });


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:users.view')->group(function () {

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

    });

    Route::middleware('permission:users.create')->group(function () {

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');

    });

    Route::middleware('permission:users.edit')->group(function () {

        Route::get('/users/{user}/edit', [UserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update');

    });

    Route::middleware('permission:users.delete')->group(function () {

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | Archives
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:archives.view')->group(function () {

        Route::get('/archives', [ArchiveController::class, 'index'])
            ->name('archives.index');

    });

    Route::middleware('permission:archives.create')->group(function () {

        Route::get('/archives/create', [ArchiveController::class, 'create'])
            ->name('archives.create');

        Route::post('/archives', [ArchiveController::class, 'store'])
            ->name('archives.store');

    });

    Route::middleware('permission:archives.edit')->group(function () {

        Route::get('/archives/{archive}/edit', [ArchiveController::class, 'edit'])
            ->name('archives.edit');

        Route::put('/archives/{archive}', [ArchiveController::class, 'update'])
            ->name('archives.update');

    });

    Route::middleware('permission:archives.delete')->group(function () {

        Route::delete('/archives/{archive}', [ArchiveController::class, 'destroy'])
            ->name('archives.destroy');

    });

    Route::middleware('permission:archives.download')->group(function () {

        Route::get('/archives/{archive}/download', [ArchiveController::class, 'download'])
            ->name('archives.download');

    });

    Route::middleware('permission:archives.preview')->group(function () {

        Route::get('/archives/{archive}/preview', [ArchiveController::class, 'preview'])
            ->name('archives.preview');

    });

/*
|--------------------------------------------------------------------------
| Staff - Peminjaman
|--------------------------------------------------------------------------
*/

Route::middleware('role:Staff')->group(function () {

    Route::get('/staff/borrowings', [StaffBorrowingController::class, 'index'])
        ->middleware('permission:borrowings.view')
        ->name('staff.borrowings.index');

    Route::get('/staff/borrowings/{borrowing}', [StaffBorrowingController::class, 'show'])
        ->middleware('permission:borrowings.view')
        ->name('staff.borrowings.show');

    Route::post('/staff/borrowings/{borrowing}/prepare', [StaffBorrowingController::class, 'prepare'])
        ->middleware('permission:borrowings.prepare')
        ->name('staff.borrowings.prepare');

    Route::post('/staff/borrowings/{borrowing}/ready', [StaffBorrowingController::class, 'ready'])
        ->middleware('permission:borrowings.confirm')
        ->name('staff.borrowings.ready');

    Route::post('/staff/borrowings/{borrowing}/borrowed', [StaffBorrowingController::class, 'borrowed'])
        ->middleware('permission:borrowings.confirm')
        ->name('staff.borrowings.borrowed');

});


});