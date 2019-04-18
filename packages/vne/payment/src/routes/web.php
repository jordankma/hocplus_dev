<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::group(['prefix' => 'vne/payment',], function (){
            Route::get('create', 'PaymentController@create')->name('vne.payment.create');
            Route::post('add', 'PaymentController@add')->name('vne.payment.add');
            Route::get('update', 'PaymentController@update')->name('vne.payment.update');
            Route::post('edit', 'PaymentController@edit')->name('vne.payment.edit');
            Route::get('manage', 'PaymentController@manage')->name('vne.payment.manage')->where('as','Phương thức thanh toán - Danh sách');
            Route::get('delete', 'PaymentController@delete')->name('vne.payment.delete');
            Route::get('log', 'PaymentController@log')->name('vne.payment.log');
            Route::get('detail-method', 'PaymentController@createDetail')->name('vne.payment.createDetail');
            Route::post('add-detail', 'PaymentController@addDetail')->name('vne.payment.addDetail');            
        });
        
    });
});