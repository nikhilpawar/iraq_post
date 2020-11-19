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
Route::get('cache_clear', function () {
		\Artisan::call('cache:clear');
			//  Clears route cache
		\Artisan::call('route:clear');
		\Artisan::call('view:clear');
		\Cache::flush();
		\Artisan::call('optimize');
		exec('composer dump-autoload');
		//return redirect(url('/').'/admin/dashboard');
		dd('cache_clear');
	});

Route::get('/', function () {
    return view('welcome');
});

include_once(base_path().'/routes/admin.php');
