<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['member.auth']], function () {
        Route::get('buy-course', 'PayController@buyCourse')->name('vne.pay.buyCourse');
        Route::post('buy-course/use-voucher', 'PayController@useVoucher')->name('vne.pay.useVoucher');
        Route::post('buy-course/create-order', 'PayController@createOrder')->name('vne.pay.createOrder');    
        Route::get('pay-course', 'PayController@payCourse')->name('vne.pay.payCourse');
        Route::post('pay-course/load-district', 'PayController@loadDistrict')->name('vne.pay.loadDistrict');
        Route::post('pay-course/load-wards', 'PayController@loadWards')->name('vne.pay.loadWards');
        Route::post('pay-course/cod', 'PayController@payCod')->name('vne.pay.payCod');
        Route::get('check-out', 'PayController@checkOut')->name('vne.pay.checkOut');
    });
   
});