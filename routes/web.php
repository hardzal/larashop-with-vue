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

Route::get('/hello', function() {
    return "Hello, Laravel!";
});

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::match(["GET", "POST"], "/register", function() {
    return redirect("/login");
})->name("register");

Route::resource("users", "UserController");

Route::get('/home', 'HomeController@index')->name('home');
