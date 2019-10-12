<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {

    Route::get('hocplus/news/demo/log', 'DemoController@log')->name('hocplus.news.demo.log');
    Route::get('hocplus/news/demo/data', 'DemoController@data')->name('hocplus.news.demo.data');
    Route::get('hocplus/news/demo/manage', 'DemoController@manage')->name('hocplus.news.demo.manage');
    Route::get('hocplus/news/demo/create', 'DemoController@create')->name('hocplus.news.demo.create');
    Route::post('hocplus/news/demo/add', 'DemoController@add')->name('hocplus.news.demo.add');
    Route::get('hocplus/news/demo/show', 'DemoController@show')->name('hocplus.news.demo.show');
    Route::put('hocplus/news/demo/update', 'DemoController@update')->name('hocplus.news.demo.update');
    Route::get('hocplus/news/demo/delete', 'DemoController@delete')->name('hocplus.news.demo.delete');
    Route::get('hocplus/news/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.news.demo.confirm-delete');
});

Route::get('news', 'NewsController@index')->name('hocplus.news.index');
Route::get('news/detail/{id}', 'NewsController@detail')->name('hocplus.news.detail');
Route::get('newsletter', 'NewsletterController@create')->name('hocplus.news.create');
Route::post('newsletter', 'NewsletterController@store')->name('hocplus.news.store');
//Route::get('comments', 'NewsController@comments')->middleware('auth')->name('hocplus.news.comments');
Route::get('news/tags/{name}', 'NewsController@tags')->name('hocplus.news.tags');
Route::get('resource/api/news', 'NewsApiController@index')->name('hocplus.news.api.index');
Route::get('resource/api/news/detail', 'NewsApiController@detail')->name('hocplus.news.api.detail');
