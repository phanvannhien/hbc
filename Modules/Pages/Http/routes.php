<?php



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web' ],
    'namespace' => 'Modules\Pages\Http\Controllers'
], function()
{

    // Admin route
    Route::group(['prefix' => Config::get('app.admin_path').'/pages', 'middleware' =>['auth:admin'] ], function(){
        Route::resource('pages', 'PagesController');
    });


    // Front route

    Route::get('pages/{page_slug}/{page_id}', 'PagesController@page')->name('page.single');

});