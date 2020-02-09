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
Route::get('dashboard', 'DashboardController@index')->middleware('auth');


Route::get('giris-yap', 'Auth\LoginController@showLoginForm');
Route::post('giris-yap', 'Auth\AuthController@login');
Route::get('cikis-yap', 'Auth\AuthController@logout');

Route::get('kayitol', 'Auth\RegisterController@showRegistrationForm')->name('register-form');
Route::post('kayitol', 'Auth\RegisterController@register')->name('register');


//Users
Route::resource('users', 'UsersController');
Route::get('kayit-ol', 'UsersController@signup')->middleware('guest');
Route::get('kayit-ol/ilk-adim', 'UsersController@checkemail')->name('verify-email');
Route::get('user/{user}', 'UsersController@showProfile')->name('users.profile');
Route::put('user/{user}/update', 'UsersController@updateProfile')->name('users.updateProfile');
Route::delete('user/{user}/delete', 'UsersController@removeUser')->name('users.removeUser');
Route::put('user/{id}/restore', 'UsersController@restoreUser')->name('users.restoreUser');

//Competitions
Route::get('yarismalar', 'CompetitionsController@index')->name('competitions.index');
Route::get('yarisma/olustur', 'CompetitionsController@create')->name('competitions.create')->middleware('auth');
Route::post('yarisma', 'CompetitionsController@store')->name('competitions.store')->middleware('auth');
Route::get('yarisma/{slug}/duzenle', 'CompetitionsController@edit')->name('competitions.edit')->middleware('auth');
Route::put('yarisma/{competition}', 'CompetitionsController@update')->name('competitions.update')->middleware('auth');
Route::delete('yarisma/{id}/sil', 'CompetitionsController@destroy')->name('competitions.delete')->middleware('auth');
Route::get('yarisma/{competition}', 'CompetitionsController@show')->name('competitions.show');
Route::get('yonetim-paneli/yarisma', 'CompetitionsController@dashboardIndex')->name('competitions.dindex')->middleware('auth');
Route::put('yarisma/{id}/geri-al', 'CompetitionsController@restore')->name('restore.competitions');

//Announcements
Route::get('duyurular', 'AnnouncementsController@index')->name('announcements.index');
Route::get('duyurular/{link}', 'AnnouncementsController@categories')->name('announcements.link');
Route::get('duyuru/olustur', 'AnnouncementsController@create')->name('announcements.create')->middleware('auth');
Route::post('duyuru', 'AnnouncementsController@store')->name('announcements.store')->middleware('auth');
Route::get('duyuru/{slug}/duzenle', 'AnnouncementsController@edit')->name('announcements.edit')->middleware('auth');
Route::get('duyuru/{link}/{slug}', 'AnnouncementsController@show')->name('announcements.show');
Route::put('duyuru/{announcement}', 'AnnouncementsController@update')->name('announcements.update')->middleware('auth');
Route::delete('duyuru/{id}/sil', 'AnnouncementsController@destroy')->name('announcements.delete')->middleware('auth');
Route::get('yonetim-paneli/duyuru', 'AnnouncementsController@dashboardIndex')->name('announcements.dindex')->middleware('auth');
Route::put('duyuru/{id}/geri-al', 'AnnouncementsController@restore')->name('announcements.competitions');

//Contents
Route::get('icerikler', 'ContentsController@index')->name('contents.index');
Route::get('icerikler/{link}', 'ContentsController@series')->name('contents.link');
Route::get('icerik/olustur/ilk-adim', 'ContentsController@create')->name('contents.create')->middleware('auth');
Route::get('icerik/olustur/son-adim', 'ContentsController@last')->name('contents.last')->middleware('auth');
Route::put('icerik/olustur/son-adim/update', 'ContentsController@lastStore')->name('contents.last-store')->middleware('auth');
Route::get('icerik/duzenle/son-adim/{id}', 'ContentsController@lastEdit')->name('contents.last-edit')->middleware('auth');
Route::put('icerik/duzenle/son-adim/{id}/update', 'ContentsController@lastStore')->name('contents.last-update')->middleware('auth');
Route::post('icerikler', 'ContentsController@store')->name('contents.store')->middleware('auth');
Route::get('icerik/{slug}/duzenle', 'ContentsController@edit')->name('contents.edit')->middleware('auth');
Route::put('icerik/{slug}', 'ContentsController@update')->name('contents.update')->middleware('auth');
Route::put('yonetim-paneli/icerik/{id}/yayinla', 'ContentsController@publish')->name('contents.publish')->middleware('auth');
Route::put('yonetim-paneli/icerik/{id}/gericek', 'ContentsController@reverse')->name('contents.reverse')->middleware('auth');
Route::get('icerik/{link}/{slug}', 'ContentsController@show')->name('contents.show');
Route::get('yonetim-paneli/icerik', 'ContentsController@dashboardIndex')->name('contents.dindex')->middleware('auth');
Route::delete('icerik/{id}/sil', 'ContentsController@destroy')->name('contents.delete')->middleware('auth');
//Route::get('icerik/olustur/son-adim', 'ContentsController@last')->name('contents.last')->middleware('auth');
//Route::put('icerik/olustur/son-adim/update', 'ContentsController@lupdate')->name('contents.lupdate')->middleware('auth');

//Content Medias
Route::get('medya/icerik/olustur', 'ContentsMediaController@create')->name('media.create')->middleware('auth');
Route::post('medya/icerik', 'ContentsMediaController@store')->name('media.store')->middleware('auth');
Route::get('medya/icerik/{id}/duzenle', 'ContentsMediaController@edit')->name('media.edit')->middleware('auth');
Route::post('medya/icerik/{id}', 'ContentsMediaController@update')->name('media.update')->middleware('auth');
Route::delete('medya/icerik/{id}/sil', 'ContentsMediaController@destroy')->name('media.delete')->middleware('auth');

//Publisher
Route::get('yazarlar', 'PublishersController@index')->name('publisher.index')->middleware('auth');
Route::get('yazar/olustur', 'PublishersController@create')->name('publisher.create')->middleware('auth');
Route::post('yazar', 'PublishersController@store')->name('publisher.store')->middleware('auth');
Route::get('yazar/{id}/duzenle', 'PublishersController@edit')->name('publisher.edit')->middleware('auth');
Route::put('yazar/{id}', 'PublishersController@update')->name('publisher.update')->middleware('auth');
Route::delete('yazar/{id}/sil', 'PublishersController@destroy')->name('publisher.delete')->middleware('auth');

Route::resource('categories', 'CategoriesController')->middleware('auth');

//Series
Route::resource('series', 'ContentSeriesController')->middleware('auth');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
