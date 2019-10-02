<div id="sidebar">
    <div class="box-sidebar">
        <h3>@lang('app.product_category')</h3>
        {!! \App\Helpers\NestableRender::renderMenuCategories($cat_product,'left-menu') !!}
    </div>

    @if( isset( $category ) )
        <?php
            $brands = \Modules\Product\Entities\Products::where('category_id', $category->id )->select('brand')->distinct('id')->get();
        ?>
        @if( $brands  )
            <div class="box-sidebar">
                <h3>Brand</h3>
                <ul>
                    @foreach( $brands  as $brand)
                    <?php
                        $currentQueries = Request::query();
                        $newQueries = ['brand' =>  $brand->brand ];
                        $allQueries = array_merge($currentQueries, $newQueries);
                    ?>
                    <li>
                        <a href="{{ Request::fullUrlWithQuery($allQueries) }}">{{ $brand->brand }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    <div class="box-sidebar">
        <h3>@lang('app.categories')</h3>
        <?php foreach ( \Modules\Blog\Entities\BlogCategory::where('category_status', 1)->get() as $category ): ?>
            <ul>
                <li>
                    <a href="{{ route('front.blog.category', ['category_slug' => $category->get_trans()->category_slug,'category_id' => $category->id ]) }}">
                        {{ $category->get_trans()->category_name }}
                    </a>
                </li>
            </ul>
        <?php endforeach ?>


        
        
    </div>
</div>




