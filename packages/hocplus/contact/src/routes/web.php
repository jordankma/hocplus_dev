<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {

    Route::get('hocplus/contact/demo/log', 'DemoController@log')->name('hocplus.contact.demo.log');
    Route::get('hocplus/contact/demo/data', 'DemoController@data')->name('hocplus.contact.demo.data');
    Route::get('hocplus/contact/demo/manage', 'DemoController@manage')->name('hocplus.contact.demo.manage');
    Route::get('hocplus/contact/demo/create', 'DemoController@create')->name('hocplus.contact.demo.create');
    Route::post('hocplus/contact/demo/add', 'DemoController@add')->name('hocplus.contact.demo.add');
    Route::get('hocplus/contact/demo/show', 'DemoController@show')->name('hocplus.contact.demo.show');
    Route::put('hocplus/contact/demo/update', 'DemoController@update')->name('hocplus.contact.demo.update');
    Route::get('hocplus/contact/demo/delete', 'DemoController@delete')->name('hocplus.contact.demo.delete');
    Route::get('hocplus/contact/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.contact.demo.confirm-delete');
    Route::get('contact/index', 'ContactController@index')->name('hocplus.contact.index');
    Route::any('contact/submit', 'ContactController@submit')->name('hocplus.contact.submit');
});