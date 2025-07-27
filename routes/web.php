<?php


use App\Http\Controllers\DatabalitaController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });


//Login
Route::get('/', [DatabalitaController::class, 'showLogin'])->name('login');
Route::post('/login', [DatabalitaController::class, 'doLogin'])->name('login.post');
Route::get('/logout', [DatabalitaController::class, 'logout'])->name('logout');

//dasboard
Route::get('/dashboard', [DatabalitaController::class, 'dashboard'])->name('dashboard');
Route::get('/data-balita/{status}', [DatabalitaController::class, 'byStatus'])->name('balita.byStatus');

// fitur
Route::get('/databalita', [DatabalitaController::class, 'total'])->name('balita.databalita');
Route::get('/create', [DatabalitaController::class, 'create'])->name('balita.create');
Route::post('/store', [DatabalitaController::class, 'store'])->name('balita.store');
Route::delete('/destroy/{id}', [DatabalitaController::class, 'destroy'])->name('balita.destroy');
Route::delete('/destroy-all', [DatabalitaController::class, 'destroyAll'])->name('balita.destroyAll');

// import file dan klasifikasi
Route::post('/import', [DatabalitaController::class, 'import'])->name('balita.import');
Route::get('klasifikasi', [DatabalitaController::class, 'klasifikasi'])->name('balita.klasifikasi');




