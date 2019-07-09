<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('api/news', 'NewsApiController@index')->name('hocplus.news.api.index');
Route::get('api/news/detail/{id}', 'NewsApiController@detail')->name('hocplus.news.api.detail');