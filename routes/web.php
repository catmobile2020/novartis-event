<?php

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::group(['prefix'=>'/','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::group(['prefix'=>'/'],function (){
        Route::get('/','AuthController@index')->name('login');
        Route::post('/','AuthController@login')->name('login');
        Route::get('/logout','AuthController@logout')->name('logout');
    });

    Route::group(['middleware'=>['auth:web','auth_type:1']],function (){
        Route::get('/home','HomeController@index')->name('home');

        Route::get('/profile','ProfileController@index')->name('profile');
        Route::post('/profile','ProfileController@update')->name('profile.update');
        Route::resource('users','UserController');
        Route::get('users/{user}/destroy','UserController@destroy')->name('users.destroy');

        Route::resource('events','EventController');
        Route::get('events/{event}/destroy','EventController@destroy')->name('events.destroy');
        Route::get('events/{event}/users','EventController@users')->name('events.users');


        Route::resource('polls','PollController');
        Route::get('polls/{poll}/destroy','PollController@destroy')->name('polls.destroy');
        Route::get('polls/{poll}/users','PollController@users')->name('polls.users');

        Route::resource('{poll}/options','PollOptionController');
        Route::get('{poll}/options/{option}/destroy','PollOptionController@destroy')->name('options.destroy');

        Route::resource('days','DayController');
        Route::get('days/{day}/destroy','DayController@destroy')->name('days.destroy');
        Route::resource('{day}/sessions','DaySessionsController');
        Route::get('{day}/sessions/{session}/destroy','DaySessionsController@destroy')->name('sessions.destroy');
        Route::get('{day}/sessions/{session}/rates','DaySessionsController@rates')->name('sessions.rates');

        Route::get('settings','SettingController@index')->name('settings.index');
        Route::post('settings','SettingController@update')->name('settings.update');

    });
});

