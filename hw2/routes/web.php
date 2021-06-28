<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', "LoginController@login")->name("login");
Route::post("/login", "LoginController@checkLogin"); 
Route::post("/logout", "LoginController@logout")->name("logout");


Route::get('/register', "RegisterController@checklog");
Route::get('/register', "RegisterController@view")->name('register');
Route::post('/register', "RegisterController@create");
Route::get('/register/username/{q}', "RegisterController@checkUsername")->name('checkUser');
Route::get('/register/email/{q}', "RegisterController@checkEmail")->name('checkEmail');
//1:40 min

Route::get('/home', "HomeController@home")->name("home");


Route::get('/news', "NewsController@news")->name("news");
Route::get('/news/weather/{q}', "NewsController@weather")->name("api_weather");
Route::get('/news/news', "NewsController@listaNews")->name("eventi");
Route::get('/news/search/{q}', "NewsController@search")->name("search");
Route::get('/news/pref', "NewsController@favorite")->name("preferiti");
Route::get('/news/aggPref/{query}', "NewsController@addFavorite")->name("aggPref");
Route::get('/news/remove/{q}', "NewsController@remove_pref")->name("remove");

Route::get('/video', "VideoController@video")->name("video");
Route::get('/video/carousel', "VideoController@carousel")->name("carousel");

Route::get('/member', "MemberController@check")->name("member");
Route::get('/member/check/{query}', "MemberController@checkTeam")->name('checkTeam');
Route::get('/member/create/{query}', "MemberController@createTeam")->name('newTeam');
Route::get('/member/add', "MemberController@teamList")->name('teamList');
Route::get('/member/prefM', "MemberController@preferiti")->name('prefM');
Route::get('/member/deleteM/{q}', "MemberController@remove")->name('deleteM');
Route::get('/member/infoT', "MemberController@infoTeam")->name('infoT');
Route::get('/member/p4/{q}', "MemberController@procedure4")->name('p4');
Route::get('/member/join/{q}', "MemberController@join")->name('join');
Route::get('/member/leave', "MemberController@leave")->name('leave');
