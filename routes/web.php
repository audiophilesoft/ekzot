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


// Redirects

$rs = config('redirects.data');

foreach ($rs as $old => $new) {
    Route::redirect($old, $new, 301);
}



// Authentication Routes...
Route::post('register', 'Auth\RegisterController@register')
    ->name('register');

Route::get('login', 'Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')
    ->name('logout');


// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')
    ->name('register');



// Password Reset Routes...

Route::get('request_password', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request')->middleware('guest');

Route::post('request_password', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email')->middleware('guest');


Route::get('reset_password/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');


Route::post('reset_password', 'Auth\ResetPasswordController@reset')
    ->name('password.do_reset');

Route::get('confirm_registration', 'Auth\RegisterController@confirm' );

Route::get('resend_confirmation', 'Auth\RegisterController@resend' )
    ->middleware('auth');


// This routing makes me cry. I can't specify URL patterns and can't use GET query with model binding

Route::get('/', 'PagesController@index')->name('pages.index');


Route::get('/load_others', 'ArticlesController@loadMoreOnMain')->name('articles.more_main');

Route::get('/{page}', 'PagesController@show')->name('pages.show');

Route::get('/create', 'PagesController@create')
    ->middleware('auth');

Route::post('/store', 'PagesController@store')->name('pages.store')
    ->middleware('auth');

Route::get('/{page}/edit', 'PagesController@edit')
    ->middleware('auth');

Route::patch('/{page}', 'PagesController@update')
    ->middleware('auth')->name('pages.update');

Route::delete('/{page}', 'PagesController@delete')
    ->middleware('auth');

Route::post('/add_comment/{page}', 'CommentsController@store')
    ->middleware('can:create,App\Comment', 'antispam:comment')->name('pages.comment.store');

Route::delete('/delete_comment/{comment}', 'CommentsController@delete')
    ->middleware('can:delete,comment')->name('comment.delete');

Route::get('/edit_comment/{comment}', 'CommentsController@edit')
    ->middleware('can:update,comment')->name('comment.edit');

Route::patch('/edit_comment/{comment}', 'CommentsController@update')
    ->middleware('can:update,comment')->name('comment.update');

Route::post('/like_comment/{comment}', 'CommentsController@like')
    ->middleware('can:like,comment')->name('comment.like');




Route::prefix('/'.config('site.articles.url'))->group(function () {
    //Route::get('/', 'ArticlesController@index')->name('articles.index');
    Route::get('/{catalogue}/', 'ArticlesController@showCat')->name('articles.cat');
    Route::get('/{catalogue}/load_others', 'ArticlesController@loadMoreInCat')->name('articles.others');
    Route::get('/create', 'ArticlesController@create')
        ->middleware('auth')->name('articles.create');

    Route::post('/store', 'ArticlesController@store')
        ->middleware('auth')->name('articles.store');

    Route::get('/{catalogue}/{article}', 'ArticlesController@show')->name('articles.show');

    Route::get( '/{article}/edit', 'ArticlesController@edit')
        ->middleware('auth')->name('articles.edit');

    Route::post('/add_comment/{article}', 'CommentsController@store')
        ->middleware('can:create,App\Comment')->middleware('antispam:comment')->name('articles.comment.store');

    Route::patch( '/{article}', 'ArticlesController@update')
        ->middleware('auth')->name('articles.update');

    Route::delete('/{article}', 'ArticlesController@delete')
        ->middleware('auth')->name('articles.delete');
});