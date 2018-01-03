<?php
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
Auth::routes();

Route::group(['middleware' => ['auth']], function() {

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dataTransaksi', 'DashboardController@dataTransaksi');
Route::get('/detailCucian/{id?}', 'DashboardController@detailCucian');
Route::put('/bayar/{id?}','DashboardController@bayar');


Route::get('/Laporan', function () {
    return view('laporan');
});
Route::get('/laporanbelumlunas', 'laporanController@dataBelumLunas');
Route::get('/laporanlunas', 'laporanController@dataLunas');

Route::get('/Transaksi', 'TransaksiController@index');
Route::get('/dataTransaksiTmp', 'TransaksiController@dataTransaksi');
Route::get('/AutoNumberTrx', 'TransaksiController@autonumber');
Route::post('/dataCucian','TransaksiController@tambah');
Route::get('/dataCucian/{id?}','TransaksiController@edit');
Route::put('/dataCucian/{id?}','TransaksiController@update');
Route::get('/hapusCucian/{id?}','TransaksiController@destroy');
Route::post('/simpanTransaksi','TransaksiController@simpan');


Route::get('/Pelanggan', function () {
    return view('pelanggan');
});
Route::get('/dataPelanggan', 'PelangganController@dataPelanggan');
Route::post('/dataPelanggan','PelangganController@insert');
Route::put('/dataPelanggan/{id?}','PelangganController@update');
Route::get('/dataPelanggan/{id?}','PelangganController@edit');


Route::get('/Jenislaundry', function () {
    return view('jenislaundry');
});
Route::get('/dataJenislaundry', 'JenislaundryController@dataJenislaundry');
Route::post('/dataJenislaundry','JenislaundryController@insert');
Route::put('/dataJenislaundry/{id?}','JenislaundryController@update');
Route::get('/dataJenislaundry/{id?}','JenislaundryController@edit');

Route::get('/CetakNota/{id?}', 'CetaknotaController@index');
Route::get('/dataCucianNota/{id?}', 'CetaknotaController@dataCucian');

Route::get('/UbahSandi', function () {
    return view('ubahsandi');
});
Route::post('/UbahSandi', 'DashboardController@ubah');

});

Route::get('logout', 'Auth\LoginController@logout');