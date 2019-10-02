@extends('layouts.app')

@section('content')
    <main class="main {{ ( Route::current()->getName() == 'home' ) ? 'no-pd-top' : '' }}">


        <div id="main-slider" class="clearfix">
            <div class="container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <a href="#slide1"><img src="{{ url('img/banner01.jpg') }}" alt=""></a>
                        </li>
                        <li>
                            <a href="#slide2"><img src="{{ url('img/banner02.jpg') }}"  alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">

            <h2 class="mb-3 text-center">@lang('app.our_products')</h2>
            <?php
            $catRoot = \Modules\Product\Entities\CategoryProducts::where('parent_id',0)
                ->select('id','category_image')
                ->get();
            ?>
            <div class="row align-items-stretch justify-content-center">
            @foreach( $catRoot as $c )
            <div class="mb-3 col-6 col-sm-3 col-xl-4 text-center">
                <a href="{{ route('front.category', ['slug' => $c->get_trans()->category_slug, 'id' => $c->id ] ) }}">
                    <img class="img-thumbnail mb-3" src="{{$c->category_image}}" alt="{{ $c->get_trans()->category_name }}">
                    <h3 class="pl-2">
                        {{ $c->get_trans()->category_name }}
                    </h3>
                </a>
            </div>
            @endforeach
            </div>

        </div>
    </main>
@endsection
