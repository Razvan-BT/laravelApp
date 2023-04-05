<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->middleware(['auth', 'verified']);

// Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/dashboard/links', function () {
//     return Inertia::render('Links');
// })->middleware(['auth', 'verified'])->name('dashboard.links');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/insert', [DashboardController::class, 'insertLinks'])->name('dashboard.insert');
    Route::post('/dashboard/insert', [DashboardController::class, 'AddLink'])->name('dashboard.add');
    Route::delete('/dashboard/insert', [DashboardController::class, 'DeleteLink'])->name('dashboard.delete');
});

Route::get('/dashboard/links', function () {
    return Inertia::render('Links');
})->middleware(['auth', 'verified'])->name('dashboard.links');

Route::get('/dashboard/links', [DashboardController::class, 'showData'])->middleware(['auth', 'verified'])->name('dashboard.links');
Route::get('/dashboard/accounts', [DashboardController::class, 'showDataAccounts'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users/{id}', [UserController::class, 'showData'])->middleware(['auth', 'verified'])->name('users.showData');
Route::post('/users/change/{id}', [UserController::class, 'change'])->middleware(['auth', 'verified'])->name('users.change');

require __DIR__.'/auth.php';
