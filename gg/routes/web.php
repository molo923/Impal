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

use Illuminate\Auth\Events\Registered;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('nasabah', 'NasabahController');
Route::resource('pegawai', 'PegawaiController');
Route::match(['put', 'patch'], 'pegawai/status/{pegawai}', 'PegawaiController@toggleStatus')->name('pegawai.toggle-status');
Route::resource('driver', 'DriverController')->middleware(['auth', 'driver']);

Route::get('testemail', function () {
    $user = \App\User::find(6);

    event(new Registered($user));
});

Route::get('layoutemail', function () {
    $markdown = new \Illuminate\Mail\Markdown(view(), config('mail.markdown'));
    $verifyUrl = '';

    return $markdown->render('notifications::email', [
        'level' => '',
        'introLines' => ['Harap konfirmasi bahwa anda ingin menggunakan ini sebagai alamat email akun Gonigoni anda.'],
        'outroLines' => ['Jika anda merasa tidak pernah melakukan pendaftaran pada Gonigoni, silahkan abaikan email ini.'],
        'actionText' => 'Verfikasi Email',
        'actionUrl' => 'uauauauaua',
        'greeting' => 'Selamat Datang di Gonigoni!',
        'salutation' => ' '
    ]);
});
