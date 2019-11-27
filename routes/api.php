<?php

use App\Setoran;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/setorans/{setoran}', 'Banksampah\SetoranController@show');
Route::post('/sampah-keluar/{sampah_keluar}', 'Banksampah\SampahkeluarController@show');
Route::post('/jadwals', 'Banksampah\JadwalController@index');
Route::post('/jemputs', 'Banksampah\JemputController@index');
Route::post('/kategori-sampah/{kategorisampah}', 'Banksampah\KategorisampahController@show');
Route::post('/check-username', function (Request $request) {
    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'username' => 'nullable|unique:users',
        'email' => 'nullable|unique:users',
        'phone_number' => 'nullable|unique:users',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages()
        ], 200);
    }

    return response()->json([
        'valid' => true,
    ]);
});
