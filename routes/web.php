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




/**
 * System routing
 */

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{


    // Admin route
    Route::group([
        'prefix' => Config::get('app.admin_path')
    ], function(){


        Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Admin\LoginController@login')->name('admin.login.submit');
        Route::get('/', 'AdminController@index')->name('admin.dashboard');


        Route::group([
            'prefix' => 'systems',
            'middleware' =>['auth:admin']
        ], function(){

            Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
            Route::resource('languages','LanguagesController');
            Route::resource('continent','ContinentController');
            Route::resource('country','CountryController');
            Route::resource('city','CityController');
            Route::resource('contact','Admin\ContactController');



        });


        Route::group([
            'prefix' => 'frontend',
            'middleware' =>['auth:admin']
        ], function(){
            Route::resource('menus','MenuController');

            // Configuration
            Route::get('configuration',array('as'=>'back.configuration', 'uses' => 'ConfigurationController@configuration'));
            Route::post('configuration',array('as'=>'back.configuration.save', 'uses' => 'ConfigurationController@configurationSave'));
            
            
            //  Route::resource('menu','LanguagesController');
        });


    });

    Auth::routes();



    // Front-end route

    Route::get('/','HomeController@index')->name('home');

    Route::get('product-category/{slug}/{id}', 'HomeController@category')->name('front.category');
    Route::get('product/{slug}/{id}', 'HomeController@product')->name('product.detail');

    Route::post('cart/add', 'CartController@addcart')->name('ajax.addcart');
    Route::get('cart/mini', 'CartController@ajaxCart')->name('ajax.getcart');
    Route::get('cart', 'CartController@viewcart')->name('cart.viewcart');
    Route::post('cart', 'CartController@updatecart')->name('cart.update');
    Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
    Route::post('checkout', 'CartController@purchase')->name('cart.purchase');
    Route::get('checkout-success/{order_id}', 'CartController@checkoutSuccess')->name('checkout.success');


    Route::get('/search','AjaxController@search')->name('search');
    Route::get('/search-form','HomeController@searchSubmit')->name('page.search');
    Route::get('/compare','AjaxController@compare')->name('page.compare');

    Route::get('/compare-items','HomeController@compare_item')->name('page.compare.item');

    Route::get('/contact','HomeController@contact')->name('page.contact');
    Route::post('/contact','HomeController@contact_save')->name('page.contact.save');





});


