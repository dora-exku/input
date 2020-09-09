<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('input.create', ['school_id' => request()->get('school_id')]);
})->name('root');

Route::get('/do/{key?}', function ($key) {
    // 限制只能扫码打开
//    if ($key === '1782bd51de4080388a4bffe495f2695d') {
//        \Illuminate\Support\Facades\Cache::add('qrcode.' . request()->ip(), 1);
//        return redirect()->route('input.create');
//    }
    return '';
})->name('do');

// 首页
Route::get('/input', 'InputController@index')->name('input.index');
// 创建
Route::get('/input/create', 'InputController@create')->name('input.create');
// 提交
Route::post('/input', 'InputController@store')->name('input.store');
// 支付
ROute::get('/pay/view/{order}', 'PayController@view')->name('pay.view');
// 支付回调
Route::post('/pay/notify', 'PayController@notify')->name('pay.notify');

Route::get('/qrcode', function () {
    return \PHPQRCode\QRcode::png(request()->get('url'));
})->name('qrcode');
