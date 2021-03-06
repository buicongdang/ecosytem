<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OauthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('oauth', [OauthController::class, 'oauth']);
Route::get('oauth/callback', [OauthController::class, 'oauthCallback']);
Route::get('test-request', [OauthController::class, 'testRequest']);


Route::get('health-check', function() {
    // $mongo    = \Illuminate\Support\Facades\DB::connection('mongodb')->getMongoClient()->listDatabases();
    $postgres = \Illuminate\Support\Facades\DB::connection()->getPdo();
    $redis    = \Illuminate\Support\Facades\Redis::connection()->ping('ok');
    return [
        // 'mongo'    => $mongo,
        'postgres' => $postgres,
        'redis'    => $redis,
    ];
});
Route::get('php-info', function() {
    echo phpinfo();
});