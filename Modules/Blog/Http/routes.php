<?php


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web' ],
    'namespace' => 'Modules\Blog\Http\Controllers'
], function()
{
    // Admin route
    Route::group(['prefix' => Config::get('app.admin_path').'/blog', 'middleware' =>['auth:admin'] ], function(){
        Route::resource('blog_categories', 'CategoryBlogController');
        Route::resource('post', 'PostController');
    });

    //Front route

    Route::get('category/{category_slug}/{category_id}', 'CategoryBlogController@frontCategory' )->name('front.blog.category');
    Route::get('post/{post_slug}/{post_id}', 'CategoryBlogController@frontPost' )->name('front.blog.post');


});

