<?php

Route::group(['namespace' => 'Api'] ,function (){
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register')->name('api.register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('reset-password', 'AuthController@resetPassword');
    });
    Route::group(['middleware'=>['auth:api']],function (){
        Route::group(['prefix' => 'account'], function () {
            Route::get('/me','ProfileController@me');
            Route::post('/update','ProfileController@update')->name('api.account.update');
            Route::post('/update-password','ProfileController@updatePassword');
        });


        Route::get('/notifications','ProfileController@allNotifications');
        Route::get('/events','EventController@index');
        Route::post('/events/{event}/attendance','EventController@attendance');
        Route::get('/agenda','HomeController@agenda');
        Route::get('/agenda/{day}','HomeController@singleDay');
        Route::post('/sessions/{session}/rating','HomeController@submitRate');
        Route::get('/speakers','HomeController@speakers');
        Route::get('/speakers/{speaker}','HomeController@singleSpeaker');
        Route::apiResource('/questions','QuestionController');
        Route::apiResource('/polls','VotingController');
        Route::apiResource('/posts','PostController');
        Route::post('/posts/{post}/make-comment','PostController@makeComment');

        Route::apiResource('/practices','PracticeController');
        Route::post('/practices/options/rating','PracticeController@optionRates');

        Route::get('/agenda-rating','AgendaRateQuestionController@index');
        Route::post('/agenda-rating/{rate_question}','AgendaRateQuestionController@submitRating');
        Route::post('/agenda-rating-by-string/{rate_question}','AgendaRateQuestionController@submitRatingByString');
    });
    Route::get('/setting','HomeController@setting');

});
