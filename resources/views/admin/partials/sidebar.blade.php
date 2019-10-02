<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <?php $currentRouteName = Route::current(); ?>
            <li class="{{ strrpos($currentRouteName->getPrefix(), 'systems')?'active':'' }} treeview" >
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{ trans('app.configurations') }}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($currentRouteName->getName() == 'languages.index') ? 'active' : '' }}">
                        <a href="{{ route('languages.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('languages.languages') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'continent.index') ? 'active' : '' }}">
                        <a href="{{ route('continent.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('continent.continent') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'country.index') ? 'active' : '' }}">
                        <a href="{{ route('country.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('country.country') }}
                        </a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'city.index') ? 'active' : '' }}">
                        <a href="{{ route('city.index') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('city.city') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ ($currentRouteName->getName() == 'pages.index') ? 'active' : '' }}">
                <a href="{{ route('pages.index') }}"><i class="fa fa-file-pdf-o"></i> {{ trans('app.pages') }}</a>
            </li>

            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'products')?'active':'' }}">
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-cube"></i> <span>@lang('product::product.product')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($currentRouteName->getName() == 'categories.index') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> @lang('product::product.categories')</a></li>
                    <li class="{{ ($currentRouteName->getName() == 'products.index') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i> @lang('product::product.products')</a></li>
                    <li class="{{ ($currentRouteName->getName() == 'customer.index') ? 'active' : '' }}">
                        <a href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i> @lang('product::customer.customer')</a></li>
                    <li class="{{ ($currentRouteName->getName() == 'order.index') ? 'active' : '' }}">
                        <a href="{{ route('order.index') }}"><i class="fa fa-circle-o"></i> @lang('product::order.order')</a></li>
                </ul>
            </li>

            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'blog') ? 'active':'' }}">
                <a href="#">
                    <i class="fa fa-cube"></i> <span>@lang('app.blog')</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($currentRouteName->getName() == 'blog_categories.index') ? 'active' : '' }}">
                        <a href="{{ route('blog_categories.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('blog::category.category')</a></li>
                    <li class="{{ ($currentRouteName->getName() == 'post.index') ? 'active' : '' }}">
                        <a href="{{ route('post.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('blog::post.post')</a></li>
                </ul>
            </li>

            <li class="{{ ($currentRouteName->getName() == 'contact') ? 'active' : '' }}">
                <a href="{{ route('contact.index') }}"><i class="fa fa-file-pdf-o"></i> {{ trans('app.contact') }}</a>
            </li>

            <li class="treeview {{ strrpos($currentRouteName->getPrefix(), 'frontend')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-cube"></i> <span>@lang('app.front_end')</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($currentRouteName->getName() == 'menus.index') ? 'active' : '' }}">
                        <a href="{{ route('menus.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('app.menu')</a>
                    </li>
                    <li class="{{ ($currentRouteName->getName() == 'back.configuration') ? 'active' : '' }}">
                        <a href="{{ route('back.configuration') }}">
                            <i class="fa fa-circle-o"></i> @lang('app.config')</a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>