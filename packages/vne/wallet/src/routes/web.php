<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['member.auth']], function () {
        Route::get('quan-ly-hoc-sinh-vi.html', 'WalletController@manage')->name('vne.wallet.manage');
        Route::get('quan-ly-hoc-sinh-nap-tien.html', 'WalletController@recharge')->name('vne.wallet.recharge');
        Route::get('check-in', 'WalletController@checkIn')->name('vne.wallet.checkIn');
        Route::post('recharge/vnpay', 'WalletController@rechargeVnpay')->name('vne.wallet.rechargeVnpay');
        Route::get('recharge/vnpay-callback', 'WalletController@rechargeVnpayCallback')->name('vne.wallet.rechargeVnpayCallback');
        Route::post('recharge/card', 'WalletController@card')->name('vne.wallet.card');
        Route::post('recharge/transfer', 'WalletController@transfer')->name('vne.wallet.transfer');

        //captcha        
        Route::get('wallet/refresh_captcha', 'WalletController@refreshCaptcha')->name('refresh_captcha');
    });
  
});