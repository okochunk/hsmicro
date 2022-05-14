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

//use App\Mail\Pigeon;

// Landing Page
Route::get('/', function () {
    return redirect('login');
});

Route::get('notactive', 'Auth\RegisterController@notActive')->name('notactive');

//Admin Auth
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('/order', 'OrdersController@index')->name('admin.order');
    Route::get('/order/{uuid}', 'OrdersController@detail')->name('admin.order.detail');
    Route::post('/order/{uuid}/update', 'OrdersController@updateStatus')->name('order.update.status');

    Route::resource('categories', 'CategoriesController');
    Route::resource('products', 'ProductsController');
    Route::resource('users', 'UsersController');

    Route::resource('user_notifications', 'UserNotificationController');

    Route::resource('characters', 'CharactersController');
});

//Customer Auth
Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'role:customer']], function () {
    Route::get('/home', 'Customer\HomeController@index')->name('home');
    Route::get('/order', 'Customer\OrderController@index')->name('order');

    Route::get('/cart/create', 'Customer\OrderController@create')->name('cart.create');
    Route::post('/cart/create', 'Customer\OrderController@postCart')->name('cart.postcart');
    Route::get('/cart/remove/{id}', 'Customer\OrderController@productDestroy')->name('cart.remove.product');

    Route::post('/order/create/', 'Customer\OrderController@store')->name('order.store');
    Route::get('/order/{uuid}', 'Customer\OrderController@detail')->name('order.detail');

    Route::get('/order/{uuid}/repeat', 'Customer\OrderController@repeatOrder')->name('order.repeat');
});

Route::post('logout/user', 'Auth\LoginController@logout')->name('logout.custom');

Auth::routes();

