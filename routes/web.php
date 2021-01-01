<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/scorecards');

#Route::resource('scorecards', 'scorecardController');

Route::get('/scorecards',                           'ScorecardController@index');

Route::get('/scorecards/{scorecard}',               'ScorecardController@show');

Route::post('/scorecards',                          'ScorecardController@store');

Route::delete('/scorecards/{scorecard}',            'ScorecardController@destroy');

//These 2 are the same
Route::get('/scorecards/Create_Scorecard/{courseid}/{numholes}', 'ScorecardController@showScorecard');//create
#Route::get('/scorecard/create',                    'ScorecardController@create');


Route::get('/scorecards/Number_of_Holes_Played',    'ScorecardController@numberofHolesPlayed'); //HolePlayed Index? Static page

Route::get('/holesplayed',                          'ScorecardController@numberofHolesPlayed'); //HolePlayed Index? Static page

Route::get('/scorecards/Select_a_Course/search',     'ScorecardController@search');//CourseSearch Update?

Route::get('/scorecards/Select_a_Course/{numholes}', 'ScorecardController@selectaCourse');//CourseSearch index




Route::get('/advancedstats',                        'AdvancedStatsController@index');