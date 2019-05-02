<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {

    Route::get('hocplus/rating/demo/log', 'DemoController@log')->name('hocplus.rating.demo.log');
    Route::get('hocplus/rating/demo/data', 'DemoController@data')->name('hocplus.rating.demo.data');
    Route::get('hocplus/rating/demo/manage', 'DemoController@manage')->name('hocplus.rating.demo.manage');
    Route::get('hocplus/rating/demo/create', 'DemoController@create')->name('hocplus.rating.demo.create');
    Route::post('hocplus/rating/demo/add', 'DemoController@add')->name('hocplus.rating.demo.add');
    Route::get('hocplus/rating/demo/show', 'DemoController@show')->name('hocplus.rating.demo.show');
    Route::put('hocplus/rating/demo/update', 'DemoController@update')->name('hocplus.rating.demo.update');
    Route::get('hocplus/rating/demo/delete', 'DemoController@delete')->name('hocplus.rating.demo.delete');
    Route::get('hocplus/rating/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.rating.demo.confirm-delete');
    Route::get('rating/{course_id?}', 'RatingController@index')->name('hocplus.rating.index');
    Route::any('rate/submit', 'RatingController@submit')->name('hocplus.rating.submit');    
});


