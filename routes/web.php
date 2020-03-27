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

Route::get('phpinfo', function () {
    $desired_debug_env = 'local';

    if (app()->environment($desired_debug_env)):
        phpinfo();
    else:
        return 'Enviroment is not '.$desired_debug_env;
    endif;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
