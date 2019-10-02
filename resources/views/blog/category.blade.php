@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    @include('partials.sidebar')
                </div>
                <div class="col-md-9">
                    <h2 class="page-title">{{ $category->get_trans()->category_name }}</h2>
                    @if( $posts )

                        @foreach( $posts as $post )
                            <div class="post clearfix mb-3">
                                <div class="row align-items-stretch">
                                    <div class="col-sm-4">
                                        <a href="{{ route('front.blog.post', ['post_slug' => $post->get_trans()->post_slug, 'post_id' => $post->id  ]) }}">
                                            <img src="{{ $post->post_thumbnail }}" class="img-thumbnail mb-3" alt="">
                                        </a>
                                    </div>
                                    <div class="col-sm-8">
                                        <h3>
                                            <a href="{{ route('front.blog.post', ['post_slug' => $post->get_trans()->post_slug, 'post_id' => $post->id  ]) }}">
                                                {{ $post->get_trans()->post_title }}
                                            </a>
                                        </h3>
                                        <div class="post-excerpt">
                                            {{ \Illuminate\Support\Str::words($post->get_trans()->post_excerpt,20) }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="clearfix text-center">
                        {!! $posts->appends(request()->input())->links() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
