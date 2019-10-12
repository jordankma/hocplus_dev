<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::group(['prefix' => 'vne/statistical',], function (){
            Route::get('manage', 'StatisticalController@index')->name('vne.statistical.manage')->where('as','Statistical - Thống kê');
            Route::get('search', 'StatisticalController@search')->name('vne.statistical.search');            
        }); 
    });
});