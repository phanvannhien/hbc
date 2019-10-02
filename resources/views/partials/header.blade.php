<header>
    <div id="top-bar" class="clearfix">
        <div class="container">
            <ul class="languages">
                <li>
                    <a href="tel:{{ \App\Helpers\Configuration::getConfig('phone') }}">
                        <i class="fa fa-phone"></i> {{ \App\Helpers\Configuration::getConfig('phone') }}
                    </a>
                    <a class="d-none d-sm-inline" href="mailto:{{ \App\Helpers\Configuration::getConfig('email') }}">
                        <i class="fa fa-envelope"></i> {{ \App\Helpers\Configuration::getConfig('email') }}
                    </a>
                </li>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <img src=" {{ url('img/flags/32/'.$properties['name'].'.png') }} " alt="">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div id="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 ">
                    <div id="logo" class="text-sm-left float-left">
                        <h1><a href="{{ route('home') }}">HBC</a></h1>
                    </div>
                    <a href=""></a>


                </div>
                <div class="col-md-5">
                    <div id="header-search" class="mb-3">
                        <form id="frm-search" action="{{ route('page.search') }}" class="form-inline">
                            <input autocomplete="off" value="{{ Request::get('q') }}" type="text"
                                   name="q" class="form-control" placeholder="search...">
                            <button type="submit" name="search">@lang('app.search')</button>
                        </form>
                        <div id="search-results"></div>
                    </div>
                </div>
                <div class="col-md-4  text-center text-md-right">

                        @if( !Auth::check() )
                            <a href="{{ route('login') }}"><i class="fa fa-user"></i> @lang('auth.login')</a> |
                            <a href="{{ route('register') }}">@lang('auth.register')</a>
                        @else
                            <div class="dropdown d-inline-flex">
                                <a href="#" data-toggle="dropdown" ><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">@lang('product::customer.profile')</a>
                                    <a class="dropdown-item" href="{{ route('user.address_book') }}">@lang('product::customer.address_book')</a>
                                    <a class="dropdown-item" href="{{ route('user.order') }}">@lang('product::customer.order_history')</a>
                                    <a class="dropdown-item" href="{{ route('user.change_password') }}">@lang('product::customer.change_password')</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="post">
                                        {{ csrf_field() }}
                                        <a class="dropdown-item" onclick="$(this).parent().submit()" href="javascript:;">@lang('customer.logout')</a>
                                    </form>

                                </div>
                            </div>
                        @endif

                        <div class="dropdown d-inline-flex">
                            <a class="float-right dropdown-toggle" href="#" role="button"
                               id="mini-cart-link"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="mini-cart-price"> {{ number_format(Cart::getTotal()).' '.config('app.price_suffix') }}</span>
                            </a>
                            <div id="mini-cart" class="dropdown-menu dropdown-menu-right" aria-labelledby="mini-cart" ></div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</header>

<div id="main-nav-container" class="d-none d-md-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <nav id="main-nav" class="clearfix">
                    <ul id="main-menu">
                    <li>
                        <a href=""> <i class="fa fa-bars"></i> @lang('product::product.product')</a>
                        {!! \App\Helpers\NestableRender::renderMenuCategories( $cat_product ) !!}
                    </li>
                    </ul>
                </nav>

            </div>
            <div class="col-sm-9">

                <ul id="primary-menu">
                    <li>
                        <a href="{{ url('/') }}">@lang('app.home')</a>
                    </li>

                    <li>
                        <?php $page = Modules\Pages\Entities\Page::findOrFail(9) ?>
                        <a href="{{ route('page.single', array('page_slug' => $page->get_trans()->slug, 'page_id' => $page->id )) }}">@lang('app.about')</a>
                    </li>
                    <li>
                        <a href="">Blog</a>
                        <ul class="sub-menu">
                        <?php foreach ( \Modules\Blog\Entities\BlogCategory::where('category_status', 1)->get() as $category ): ?>

                            <li>
                                <a href="{{ route('front.blog.category', ['category_slug' => $category->get_trans()->category_slug,'category_id' => $category->id ]) }}">
                                    {{ $category->get_trans()->category_name }}
                                </a>
                            </li>
                        <?php endforeach ?>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('page.contact') }}">@lang('app.contact_us')</a>
                    </li>
                </ul>

            </div>
        </div>

    </div>
</div>