<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > About
Breadcrumbs::register('about', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
//    $breadcrumbs->push('About', route('about'));
});


// Home > About
Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
//    $breadcrumbs->push('Contact', route('about'));
});

// Home / Product
Breadcrumbs::register('products', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
//    $breadcrumbs->push('Products', route('product.catalog'));
});



// Home / Cart
Breadcrumbs::register('cart', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push( trans('product::product.cart'), route('cart.viewcart'));
});


//// Home / Payment
//Breadcrumbs::register('payment', function ($breadcrumbs) {
//    $breadcrumbs->parent('home');
//    $breadcrumbs->push('Payment', route('user.checkout'));
//});