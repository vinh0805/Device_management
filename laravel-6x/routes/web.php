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

// Login
Route::get('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::post('/login-confirm', 'LoginController@loginConfirm');

// User
Route::get('/me', 'UserController@showProfile');
Route::post('/update-profile/{userId}', 'UserController@updateProfile');

Route::get('/me/password', 'UserController@changePassword');
Route::post('/update-password/{userId}', 'UserController@updatePassword');

Route::get('/users/lists', 'UserController@showUserList');
Route::get('/users/{userId}/delete', 'UserController@deleteUser');

Route::get('/users/add', 'UserController@addUser');
Route::post('/users/save', 'UserController@saveUser');

Route::get('/users/{userId}/edit', 'UserController@editUser');
Route::post('/users/{userId}/update', 'UserController@updateUser');

Route::get('/users/{userId}/password', 'UserController@changeUserPassword');
Route::post('/users/{userId}/password/update', 'UserController@updateUserPassword');

Route::get('/users/{userId}/role', 'UserController@changeUserRole');
Route::post('/users/{userId}/role/update', 'UserController@updateUserRole');

// Device
Route::get('/devices/me', 'DeviceController@showMyDevicesList');
Route::get('/devices/lists', 'DeviceController@showDevicesList');
Route::get('/devices/{deviceId}/delete', 'DeviceController@deleteDevice');
Route::post('/devices/lists/assign/{deviceId}', 'DeviceController@assignToUser');
Route::post('/devices/lists/showHistory/{deviceId}', 'DeviceController@assignToUser');

Route::get('/devices/add', 'DeviceController@addDevice');
Route::post('/devices/save', 'DeviceController@saveDevice');

Route::get('/devices/{deviceId}/edit', 'DeviceController@editDevice');
Route::post('/devices/{deviceId}/update', 'DeviceController@updateDevice');

Route::get('/devices/lists/users', 'DeviceController@showDevicesListUsers');
Route::post('/devices/lists/get-device-info/{id}', 'DeviceController@updateDevice');

// Request
Route::get('/requests/me', 'RequestController@showMyRequestsList');
Route::get('/requests/lists', 'RequestController@showRequestsList');
Route::get('/requests/{requestId}/delete', 'RequestController@deleteRequest');
Route::get('/requests/{requestId}/approve', 'RequestController@approveRequest');
Route::get('/requests/{requestId}/reject', 'RequestController@rejectRequest');

Route::get('/requests/add', 'RequestController@addRequest');
Route::post('/requests/save', 'UserController@saveRequest');

Route::get('/requests/{requestId}/edit', 'RequestController@editRequest');
Route::post('/requests/{requestId}/update', 'UserController@updateRequest');

Route::group(['middleware' => ['web']], function() {
    Route::resource('post', 'PostController');
    Route::POST('addPost', 'PostController@addPost');
});





//Route::get('/login', 'Auth\LoginController@getLogin')->name('login');
//Route::post('/login', 'Auth\LoginController@postLogin');
//Route::get('/logout', 'Auth\LoginController@logout');
//
//Route::group(['middleware' => ['auth']], function () {
//    Route::get('/home', function () {
//        return view('welcome');
//    });
//
//    Route::prefix('users')->name('users.')->group(function () {
//        Route::get('index', 'UserController@index')->name('list');
//    });
//});
