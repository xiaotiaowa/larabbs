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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PagesController@root')->name('root');
Auth::routes();

//Authentication Rotes
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
// //Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationFom')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
//
// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// HTTP 请求	URI	动作	作用
// GET	/users/{user}	UsersController@show	显示用户个人信息页面
// GET	/users/{user}/edit	UsersController@edit	显示编辑个人资料页面
// PATCH	/users/{user}	UsersController@update	处理 edit 页面提交的更改
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

// URI 参数 topic 是 『隐性路由模型绑定』 的提示，将会自动注入 ID 对应的话题实体。
// URI 最后一个参数表达式 {slug?} ，? 意味着参数可选，这是为了兼容我们数据库中 Slug 为空的话题数据。
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::resource('replies', 'RepliesController', ['only' =>  ['store', 'destroy']]);
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// 无权限提醒页面#
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');
