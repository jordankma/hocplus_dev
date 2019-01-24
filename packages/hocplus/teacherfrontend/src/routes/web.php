<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {
    Route::get('/dang-ky-giang-vien', 'TeacherfrontendController@index')->name('hocplus.get.register.teacher');
    Route::post('/dang-ky-gv', 'TeacherfrontendController@save')->name('hocplus.post.register.teacher');

});