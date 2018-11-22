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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes();


Route::get('daftar', 'UserController@daftar');
Route::post('daftar_store', [

	'as' => 'daftar_store',
	'uses' => 'UserController@daftar_store',
]);



Route::group(['middleware' => ['auth']], function() {
	Route::get('/', 'DashboardController@index');
	Route::get('profile', 'ProfileController@index');
	Route::post('profile/update', [
		'as' => 'profile.update',
		'uses' => 'ProfileController@update',
	]);



	Route::group(['middleware' => ['role:Panitera Muda']], function() {
		Route::resource('users', 'UserController');
		Route::resource('jenis_perkara', 'JenisPerkaraController');

		Route::resource('perkara', 'PerkaraController');
		Route::resource('riwayat_pembaca', 'RiwayatPembacaController');

	});

	Route::group(['middleware' => ['role:Panitera']], function() {
		Route::post('berkas_perkara/read', [
			'as' => 'berkas_perkara.read',
			'uses' => 'BerkasPerkaraController@read',
		]);
		Route::get('berkas_perkara/read', [
			'as' => 'berkas_perkara.read',
			'uses' => 'BerkasPerkaraController@read',
		]);
		Route::get('berkas_perkara/get_file/{berkas_id}', [
			'as' => 'berkas_perkara.get_file',
			'uses' => 'BerkasPerkaraController@get_file',
		]);
		Route::resource('berkas_perkara', 'BerkasPerkaraController');

	});


});


