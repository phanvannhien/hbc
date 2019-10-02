<?php



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web' ],
    'namespace' => 'Modules\Product\Http\Controllers'
], function()
{

    // Admin route
    Route::group(['prefix' => Config::get('app.admin_path').'/products', 'middleware' =>['auth:admin'] ], function(){

        Route::resource('categories', 'CategoryProductController');
        Route::resource('products', 'ProductController');
        Route::resource('customer', 'CustomerController');
        Route::resource('order', 'OrderController');
        Route::post('order-change-status', 'OrderController@change_status')->name('admin.order.change_status');


        Route::post('import','ProductController@import')->name('products.import');

    });


    // User role
    Route::middleware(['auth'])->group(function () {
        Route::get('user/profile', 'CustomerController@profile')->name('user.profile');
        Route::post('user/profile', 'CustomerController@profilePost')->name('user.profile.post');

        Route::get('user/change-password', 'CustomerController@get_form_change_password')->name('user.change_password');
        Route::post('user/change-password', 'CustomerController@save_change_password')->name('user.change_password.post');

        Route::get('logout', 'CustomerController@logout')->name('logout');
        Route::get('user/order', 'CustomerController@order')->name('user.order');
        Route::get('user/order/{id}', 'CustomerController@order_detail')->name('user.order.detail');

        Route::get('user/address-book', 'CustomerController@address_book')->name('user.address_book');
        Route::get('user/address-book/{id}', 'CustomerController@address_book_detail')->name('user.address_book_detail');
        Route::get('user/address-book/{id}/delete', 'CustomerController@address_book_delete')->name('user.address_book_delete');
        Route::post('user/address-book/{id}', 'CustomerController@address_book_detail_save')->name('user.address_book_detail.save');
    });




});