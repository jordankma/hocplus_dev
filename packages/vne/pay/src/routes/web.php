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
        Route::post('pay-course/card', 'PayController@payCard')->name('vne.pay.payCard');
        Route::post('pay-course/pay-vnpay', 'PayController@payVnPay')->name('vne.pay.payVnPay');
        Route::get('pay-course/vnpay-callback', 'PayController@payVnPayCallback')->name('vne.pay.payVnPayCallback');

        Route::post('pay-course/pay-tranfer', 'PayController@payTranfer')->name('vne.pay.payTranfer');
        Route::post('pay-course/pay-wallet', 'PayController@payWallet')->name('vne.pay.payWallet');
        //captcha        
        Route::get('refresh_captcha', 'PayController@refreshCaptcha')->name('refresh_captcha');
    });
    
    Route::get('pay-course/vnpay-ipn', 'PayController@vnpayIpn')->name('vne.pay.vnpayIpn');
});