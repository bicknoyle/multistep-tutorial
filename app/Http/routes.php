<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('survey', 'SurveyController@getSurvey');
Route::post('survey', 'SurveyController@postSurvey');

Route::get('survey/step/{step}', 'SurveyController@getSurveyStep')->where(['step' => '[1-3]']);
Route::post('survey/step/{step}', 'SurveyController@postSurveyStep')->where(['step' => '[1-3]']);

Route::get('survey/done', 'SurveyController@getSurveyDone');
