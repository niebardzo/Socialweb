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

Route::group(['middleware' => ['web']],function(){


    Route::get('/', [
        'uses'=>'UserController@getHome',
        'as'=>'home',
    ]);

//    Route::get('/',function() {
//        return view('welcome');
//    })->name('home');


   Route::get('dashboard', [
       'uses'=>'PostController@getDashboard',
       'as'=>'dashboard',
       'middleware'=>'auth'
   ]);


    Route::post('/signup',[
        'uses'=>'UserController@postSignUp',
        'as'=>'signup'
    ]);

    Route::post('/signin',[
        'uses'=>'UserController@postSignIn',
        'as'=>'signin'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as'=>'logout'
    ]);
    Route::post('/createpost',[
        'uses' => 'PostController@postCreatePost',
        'as' => 'post.create',
        'middleware'=>'auth'
    ]);
    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as'=> 'post.delete',
        'middleware'=>'auth'
    ]);
    Route::get('/admin-delete-post/{post_id}', [
        'uses' => 'PostController@adminDeletePost',
        'as'=> 'post.delete.admin',
        'middleware'=>'auth'
    ]);
    Route::post('/edit', [
        'uses'=>'PostController@postEditPost',
        'as' => 'edit',
        'middleware'=>'auth'
    ]);
    Route::get('/account',[
       'uses' =>'UserController@getAccount',
        'as' => 'account',
        'middleware'=>'auth'
    ]);
    Route::post('/updateaccount',[
       'uses'=>'UserController@postSaveAccount',
        'as'=>'account.save'
    ]);
    Route::get('/userimage/{filename}',[
        'uses'=>'UserController@getUserImage',
        'as'=>'account.image'
    ]);
    Route::post('/like', [
       'uses' =>'PostController@postLikePost',
        'as' => 'like'
    ]);

    //Users

    Route::get('/ranking',[
        'uses'=>'UserController@showRanking',
        'as'=>'ranking',
        'middleware'=>'auth'
    ]);
    Route::get('/users',[
        'uses'=>'UserController@showUsers',
        'as'=>'users',
        'middleware'=>'auth'
    ]);

    Route::get('/delete-user/{user_id}', [
        'uses' => 'UserController@getDeleteUser',
        'as'=> 'user.delete',
        'middleware'=>'auth'
    ]);

    //Categories

    Route::resource('categories', 'CategoryController',[
        'except'=>['create']
    ]);
    Route::get('/delete-category/{category_id}', [
        'uses' => 'CategoryController@getDeleteCategory',
        'as'=> 'category.delete',
        'middleware'=>'auth'
    ]);

    Route::get('dashboard/category/{category_id}', [
        'uses'=>'CategoryController@showAllPosts',
        'as'=>'showPosts'
    ]);


    //Calendar

    Route::resource('cal', 'gCalendarController');
    Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'gCalendarController@oauth']);
    Route::get('/calendar', [
        'uses'=>'gCalendarController@getCalendar',
        'as'=>'calendar',
        'middleware'=>'auth'
        ]);
    Route::get('/reservation', [
        'uses'=>'gCalendarController@create',
        'as'=>'reserv',
        'middleware'=>'auth'
    ]);



});

