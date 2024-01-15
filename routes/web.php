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
// ******************************************************************
// ------------------ Structura Site "Guest" ---------------------- //
// ******************************************************************

// pagina principala
Route::resource('/', 'IndexController', [
									'only' => 'index', 
									'names' => [
										'index' => 'home'
									]
								]);
// // Pagina cu portofolii
// Route::resource('portfolios', 'PortfoliosController', [
// 		'parameters' => [
// 			'portfolios' => 'alias',
// 		]
// 	]);
Route::get('portfolios', 'PortfoliosController@index')->name('portfoliosIndex');
Route::get('portfolios/{alias}', 'PortfoliosController@show')->name('portfoliosShow');


// Pagina Blog
// Route::resource('articles', 'ArticlesController', [
// 		'parameters' => [
// 			'articles' => 'alias'
// 		]
// 	]);
Route::get('articles', 'ArticlesController@index')->name('articlesIndex');
Route::get('articles/{alias}', 'ArticlesController@show')->name('articlesShow');


// Pagina cu articole pe categorie 
Route::get('/articles/cat/{cat_alias?}', 'ArticlesController@index')->name('articlesCat')->where('cat_alias', '[\w-]+');

// Pagina de prelucrare comentarii
// Route::resource('comment', 'CommentController', ['only' => ['store']]);

Route::match(['get', 'post'], '/comment', 'CommentController@store')->name('comment.store');

// Pagina Contact
Route::match(['get', 'post'], '/contact', 'ContactController@index');

// // Autentificare utilizatori
// Route::get('login', 'Auth\AuthController@showLoginForm');
// Route::post('login', 'Auth\AuthController@login');
// Route::get('logout', 'Auth\AuthController@logout');
Auth::routes();

// ******************************************************************
// ---------------- Structura Site "Admin Panel" ----------------- //
// ******************************************************************

// admin
Route::prefix('admin')->middleware(['auth'])->group(function(){
	// admin
	Route::get('/', 'Admin\IndexController@index')->name('adminIndex');

	Route::resource('/articles', 'Admin\ArticlesController');
	// Route::resource('/portfolios', 'Admin\PortfoliosController');
	Route::resource('/menus', 'Admin\MenusController');
	Route::resource('/users', 'Admin\UsersController');
	Route::resource('/permissions', 'Admin\PermissionsController');

});
