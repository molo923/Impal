<?php

/*
 * Banksampah Routes
 */

Route::get('/register', 'Auth\Banksampah\RegisterController@showRegistrationForm')->name('banksampah.register');
Route::post('/register', 'Auth\Banksampah\RegisterController@register')->name('banksampah.register');

Route::group(['middleware' => ['auth' => 'verified', 'banksampah'], 'namespace' => 'Banksampah'], function() {

    Route::get('/', 'BanksampahController@index')->name('banksampah.dashboard');

    Route::group(['prefix' => 'account'], function() {
        Route::get('/profile', 'BanksampahController@profile')->name('banksampah.profile');
        /*Route::get('/profile/edit', 'BanksampahController@profileEdit')->name('banksampah.profile.edit');*/
        Route::put('/profile/update', 'BanksampahController@profileUpdate')->name('banksampah.profile.update');

        Route::get('/edit', 'BanksampahController@accountEdit')->name('banksampah.account.edit');
        Route::put('/update', 'BanksampahController@accountUpdate')->name('banksampah.account.update');

        Route::get('/password/edit', 'BanksampahController@passwordEdit')->name('banksampah.password.edit');
        Route::put('/password/update', 'BanksampahController@passwordUpdate')->name('banksampah.password.update');

        Route::get('/bank-account', 'BanksampahController@bankAccounts')->name('banksampah.bank-account');
        Route::post('/bank-account', 'BanksampahController@bankAccountStore')->name('banksampah.bank-account.store');
        Route::put('/bank-account/update/{id}', 'BanksampahController@bankAccountUpdate')->name('banksampah.bank-account.update');
        Route::delete('/bank-account/{id}', 'BanksampahController@bankAccountDestroy')->name('banksampah.bank-account.destroy');
    });

    Route::group(['prefix' => 'dompet'], function() {
        Route::get('/', 'DompetController@index')->name('dompet.index');
        /*Route::get('/payment-list', 'DompetController@paymentList')->name('dompet.payment-list');*/
        Route::post('/pay/nasabah', 'DompetController@payNasabah')->name('dompet.pay-nasabah');
        Route::put('/pay/{id}/confirm', 'DompetController@paymentConfirm')->name('dompet.pay-confirm');
    });

    Route::resource('kategori-sampah', 'KategorisampahController')->except(['create', 'show', 'edit', 'store', 'update']);
    Route::group(['prefix' => 'kategori-sampah'], function() {

        /*Route::match(['put', 'patch'], 'status/{kategorisampah}', 'KategorisampahController@toggleStatus')->name('kategori-sampah.toggle-status');*/
        Route::match(['put', 'patch'], 'edit/{id}', 'KategorisampahController@changePrice')->name('kategori-sampah.change-price');
        Route::post('aktivasi/{id}', 'KategorisampahController@attachBanksampah')->name('kategori-sampah.activate');
        Route::post('deaktivasi', 'KategorisampahController@deactivateKategorisampah')->name('kategori-sampah.deactivate');
        Route::get('stok', 'KategorisampahController@historyStok')->name('kategori-sampah.stok');
        Route::get('stok/{stok}', 'KategorisampahController@showStok')->name('kategori-sampah.stok.show');
        Route::get('histori-stok', 'KategorisampahController@historyStok')->name('kategori-sampah.stok.history');
        Route::get('mutasi/{kategorisampah}', 'KategorisampahController@showMutasi')->name('kategori-sampah.mutasi.show');
        Route::post('mutasi/{kategorisampah}', 'KategorisampahController@storeMutasi')->name('kategori-sampah.mutasi.store');
        Route::post('residu/{kategorisampah}', 'KategorisampahController@storeResidu')->name('kategori-sampah.residu.store');
    });

    Route::resource('setoran', 'SetoranController');
    Route::put('setoran/{id}/done', 'SetoranController@done')->name('setoran.done');
    Route::put('setoran/{id}/reject', 'SetoranController@reject')->name('setoran.reject');

    Route::resource('sampah-keluar', 'SampahkeluarController');
    Route::put('sampah-keluar/{id}/done', 'SampahkeluarController@done')->name('sampah-keluar.done');
    Route::put('sampah-keluar/{id}/reject', 'SampahkeluarController@reject')->name('sampah-keluar.reject');

    Route::resource('jemput', 'JemputController');

    Route::put('jemput/{jemput}/pickup', 'JemputController@pickUp')->name('jemput.pickup');
    Route::put('jemput/{jemput}/done', 'JemputController@done')->name('jemput.done');
    Route::put('jemput/{jemput}/confirm', 'JemputController@confirm')->name('jemput.confirm');
    Route::put('jemput/{jemput}/reject', 'JemputController@reject')->name('jemput.reject');
    Route::resource('jadwal', 'JadwalController');
    Route::put('jadwal/{jadwal}/accept', 'JadwalController@acceptJadwal')->name('jadwal.accept');
    Route::put('jadwal/{jadwal}/reject', 'JadwalController@rejectJadwal')->name('jadwal.reject');
    Route::resource('finansial', 'FinansialController');

    Route::get('nasabah', 'BanksampahController@nasabahIndex')->name('banksampah.nasabah-index');
    Route::post('nasabah', 'BanksampahController@nasabahStore')->name('banksampah.nasabah-store');
    Route::get('nasabah/{nasabah}', 'BanksampahController@nasabahShow')->name('banksampah.nasabah-detail');
    Route::match(['put', 'patch'], 'nasabah/status/{nasabah}', 'BanksampahController@toggleStatus')->name('banksampah.nasabah.toggle-status');
    Route::get('pegawai', 'BanksampahController@pegawaiIndex')->name('banksampah.pegawai-index');
    Route::get('pegawai/create', 'BanksampahController@pegawaiCreate')->name('banksampah.pegawai-create');
    Route::get('driver', 'BanksampahController@driverIndex')->name('banksampah.driver-index');
});
