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

Route::get('/test', function () {
	return view('test');

    return 'hello there!!';
    return '<h1>hello there!!</h1>';
    return ['sarah', 'yara'];
    return ['name' => 'sarah', 'gender' => 'female'];
});

Route::get('/', function() {
	return view('home');
});
Route::get('/home', function() {
	return view('home');
});

Route::get('/courses', function() {
	// $data = App\Course::first();
	$data = App\Course::all();
	// $data = App\Course::limit(1)->offset(1)->get();
	// $data = App\Course::where('name',  'LIKE', '%PHP%')->get();
	// $data = App\Category::all();
	// $user = User::with('payments')->where('id', 1)->first();

	return $data;
});

Route::get('login', 'LoginController@show_view')->middleware('guest')->name('login');
Route::post('login', 'LoginController@login_process')->middleware('guest');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {

	Route::group(['prefix' => 'users'], function() {
		Route::get('', 'AdminUsersController@index');
		Route::get('create', 'AdminUsersController@create');
		Route::post('', 'AdminUsersController@store');
		Route::get('{id}', 'AdminUsersController@show');
		Route::put('{id}', 'AdminUsersController@update');
		Route::delete('{id}', 'AdminUsersController@delete');
	});

	// Route::get('courses', 'AdminCoursesController@index');
	// Route::get('courses/create', 'AdminCoursesController@create');
	// Route::post('courses', 'AdminCoursesController@store');
	// Route::get('courses/{id}', 'AdminCoursesController@show');
	// Route::put('courses/{id}', 'AdminCoursesController@update');
	// Route::delete('courses/{id}', 'AdminCoursesController@delete');

});


Route::get('logout', function() {
	Auth::logout();
	return redirect('/login');
});

Route::get('register', 'RegisterController@show_view');
Route::post('register', 'RegisterController@process');

Route::get('verify_email', function() {
	$token = request()->token;

	$user = App\User::where('email_verify_token', $token)
		->whereNotNull('email_verify_token')
		->first();

	if (empty($user)) {
		return redirect('/');
	}
	$user->email_verify_token = null;
	$user->email_verified_at = Carbon\Carbon::now();
	$user->update();

	session()->flash('success', 'your email has been verified successfully, please login!');

	return redirect('/login');
});


Route::get('test', function() {
	return env('TESTER');
	// Schema::create();
	// Schema::dropIfExists('users');
	// Schema::hasTable('users');
	// Schema::hasColumn('users', 'avatar');
	// Schema::dropColumn('users', 'avatar');
	// Schema::rename('users', 'admins');
});
