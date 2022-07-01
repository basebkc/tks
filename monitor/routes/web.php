<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\IdebController;

use App\Http\Controllers\Api\V1\NasabahController;
use App\Http\Controllers\TugasController;
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

// open without sign in
// Route::get('/', [TrackingController::class, 'index'])->name('frontend.tracking');
// Route::get('/getfile', [UserController::class, 'getfile']);
Route::get('/', [MonitorController::class, 'index'])->name('frontend.monitor');
Route::get('/getnotif', [MonitorController::class, 'getnotif'])->name('frontend.getnotif');
Route::get('/getlognotif', [MonitorController::class, 'getlognotif'])->name('frontend.getlognotif');
Route::get('/gettabelcore', [MonitorController::class, 'getTabelCore']);

Route::post('/monitor/store', [MonitorController::class, 'store'])->name('frontend.monitor.store');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

	Route::prefix('/pagenotfound')->get('/', function(){
		return view('404');
	});
    
	Route::prefix('/dashboard')->group( function (){

		Route::get('/', [BackendController::class, 'index'])->name('kreditonline.show');
		
	});

	Route::prefix('/tabungan')->group( function (){

		Route::get('/', [TabunganController::class, 'index'])->name('tabungan.index');

	});

	Route::prefix('/notifikasi')->group(function (){

		
		Route::post('/exampleTransaksiTabungan', [NotifikasiController::class, 'exampleTransaksiTabungan']);

		Route::get('/', [NotifikasiController::class, 'index'])->name('notifikasi.index');
		Route::get('/getDataTabTransaksi', [NotifikasiController::class, 'getDataTabTransaksi'])->name('notifikasi.getDataTabTransaksi');
		Route::post('/getDataLogTabTrans', [NotifikasiController::class, 'getDataLogTabTrans']
		)->name('notifikasi.getDataLogTabTrans');

		Route::get('/runwa', [NotifikasiController::class, 'runwhatapps'])->name('notifikasi.wa');
		Route::get('/getdata', [NotifikasiController::class, 'getdata'])->name('notifikasi.getdata');
	
		Route::get('/daftarnasabah', [NotifikasiController::class, 'daftar'])->name('notifikasi.daftar');
		
		//master
		Route::get('/master', [NotifikasiController::class, 'listsms'])->name('notifikasi.master');
		Route::post('/master/store', [NotifikasiController::class, 'storeMaster'])->name('notifikasi.master.store');
		Route::get('/master/show/{id}', [NotifikasiController::class, 'showMaster'])->name('notifikasi.master.show');
		
		//daftar rekening
		Route::get('/daftarnasabah/show/{id}', [NotifikasiController::class, 'show'])->name('notifikasi.daftarnasabah.show');
		
		//run sms
		// Route::get('/run', [NotifikasiController::class, 'runsms'])->name('notifikasi.run');
		
		//tabungan
		Route::post('/tabungan/store', [NotifikasiController::class, 'storeNotifTabungan'])->name('notifikasi.tabungan.store');
		Route::post('/daftarnasabah/store', [NotifikasiController::class, 'store'])->name('notifikasi.store');
		Route::get('/tabungan/show/{id}', [NotifikasiController::class, 'showNotifTabungan'])->name('notifikasi.show');
		
	});

	Route::prefix('/konfigurasi')->group( function (){
		
		Route::get('', [KonfigurasiController::class, 'index'])->name('konfigurasi.index');
		Route::get('/show/{id}', [KonfigurasiController::class, 'show'])->name('konfigurasi.show');
		Route::post('/store', [KonfigurasiController::class, 'store'])->name('konfigurasi.store');
	});

	
	Route::prefix('/user')->group( function (){
		
		Route::get('', [UserController::class, 'index'])->name('user.index');
		Route::post('/create', [UserController::class, 'create'])->name('user.create');
		Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
		
	});

	Route::prefix('/ideb')->group( function (){
		
		Route::get('', [IdebController::class, 'index'])->name('ideb.index');
		Route::post('/create', [IdebController::class, 'create'])->name('ideb.create');
		Route::get('/show/{id}', [IdebController::class, 'show'])->name('ideb.show');
		
	});

	Route::prefix('/tugas')->group( function (){
		
		Route::get('', [TugasController::class, 'index']);
		Route::get('/tracking', [TugasController::class, 'tracking']);
		Route::post('/store', [TugasController::class, 'store']);
		Route::get('/getData/{id}', [TugasController::class, 'getData']);
		Route::post('/upload', [TugasController::class, 'upload']);
		Route::post('/cetak', [TugasController::class, 'cetak']);
		Route::get('/image/{filename}',[TugasController::class, 'displayImage'])->name('tugas.displayImage');
		Route::post('/print', [TugasController::class, 'print']);

	});
	
});
