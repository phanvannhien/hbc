@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    @include('partials.sidebar')
                </div>
                <div class="col-md-9">
                    <h2 class="page-title">{{ $post->get_trans()->post_title }}</h2>
                    <p class="text-grey"><i class="fa fa-calendar-o"></i> <small>{{ $post->created_at }}</small></p>
                    <div class="post-single">
                        {!! $post->get_trans()->post_content !!}
                    </div>
                    <hr>

                    <h3 class="page-title">@lang('app.post_related')</h3>
                    <div class="row align-items-stretch">
                        @foreach( $post_related as $p )
                        <div class="col-sm-12 col-md-6 mb-sm-3">
                            <div class="row">
                                <div class="col-4  col-lg-4 col-md-12">
                                    <a href="{{ route('front.blog.post', ['post_slug' => $p->get_trans()->post_slug, 'post_id' => $p->id  ]) }}">
                                        <img src="{{ $p->post_thumbnail }}" class="img-thumbnail" alt="">
                                    </a>
                                </div>
                                <div class="col-8 col-lg-8 col-md-12">
                                    <h3>
                                        <a href="{{ route('front.blog.post', ['post_slug' => $p->get_trans()->post_slug, 'post_id' => $p->id  ]) }}">
                                            {{ $p->get_trans()->post_title }}
                                        </a>
                                    </h3>
                                    <p class="text-grey"><i class="fa fa-calendar-o"></i> <small>{{ $post->created_at }}</small></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
