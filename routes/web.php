<?php

Route::middleware('auth')->group(function () {
    Route::get('editor', 'EditorController@index')->name('editor');
});

Route::middleware('guest')->group(function () {
    Route::get('/', 'LandingController@index')->name('landing');
});

Auth::routes(['verify' => true]);
