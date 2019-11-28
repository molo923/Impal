<?php

Route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'Admin'], function () {

    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/accounts', 'AdminController@accounts')->name('admin.accounts');
    Route::get('/wallet', 'AdminController@wallet')->name('admin.wallet');
    Route::get('/banksampah', 'AdminController@banksampah')->name('admin.banksampah');
    Route::put('/banksampah/{id}/confirm', 'AdminController@banksampahConfirm')->name('admin.banksampah-confirm');
    Route::put('/user/{id}', 'AdminController@toggleUserStatus')->name('admin.user.toggle');
    Route::put('/payment/{id}/received', 'AdminController@paymentReceived')->name('admin.payment-received');
});
