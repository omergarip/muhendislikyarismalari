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

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('dashboard', 'DashboardController@index');


//Competitions
Route::get('yarismalar', 'CompetitionsController@index')->name('competitions.index');
Route::get('yarisma/olustur', 'CompetitionsController@create')->name('competitions.create')->middleware('auth');
Route::post('yarisma', 'CompetitionsController@store')->name('competitions.store')->middleware('auth');
Route::get('yarisma/{competition}', 'CompetitionsController@show')->name('competitions.show');


//Content
Route::get('icerikler', 'ContentsController@index')->name('contents.index');
Route::get('icerikler/{link}', 'ContentsController@series')->name('contents.link');
Route::get('icerik/olustur/ilk-adim', 'ContentsController@create')->name('contents.create')->middleware('auth');
Route::get('icerik/olustur/ikinci-adim', 'ContentsController@second')->name('contents.second')->middleware('auth');
Route::post('icerik/olustur/ikinci-adim/store', 'ContentsController@sstore')->name('contents.sstore')->middleware('auth');
Route::get('icerik/olustur/son-adim', 'ContentsController@last')->name('contents.last')->middleware('auth');
Route::post('icerikler', 'ContentsController@store')->name('contents.store')->middleware('auth');
Route::get('icerik/{slug}', 'ContentsController@update')->name('contents.update')->middleware('auth');
Route::get('icerik/{slug}/duzenle', 'ContentsController@edit')->name('contents.edit')->middleware('auth');
Route::get('icerik/{link}/{slug}', 'ContentsController@show')->name('contents.show');


//Series
Route::resource('series', 'ContentSeriesController');




//Announcements
Route::get('duyurular', 'AnnouncementsController@index')->name('announcements.index');
Route::get('duyurular/{link}', 'AnnouncementsController@categories')->name('announcements.link');
Route::get('duyuru/olustur', 'AnnouncementsController@create')->name('announcements.create')->middleware('auth');
Route::post('duyuru', 'AnnouncementsController@store')->name('announcements.store')->middleware('auth');
Route::get('duyuru/{link}/{slug}', 'AnnouncementsController@show')->name('announcements.show');



Route::resource('categories', 'CategoriesController');
Route::get('trashed-posts', 'CompetitionsController@trashed')->name('trashed-competitions.index');
Route::put('restore-post/{post}', 'CompetitionsController@restore')->name('restore.competitions');
