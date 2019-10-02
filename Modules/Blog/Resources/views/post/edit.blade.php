
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('blog::post.post')</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form action="{{ route('post.update', $post->id) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach( LaravelLocalization::getSupportedLocales() as $key => $lang )
                                        <li class="{{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}">
                                            <a href="#tab_{{ $key }}" data-toggle="tab">{{ $lang['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach( LaravelLocalization::getSupportedLocales() as $key => $lang )
                                        <?php
                                        $item = $post->get_trans_by( $key );
                                        ?>
                                        <div class="tab-pane {{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}" id="tab_{{ $key }}">
                                            <div class="form-group">
                                                <label for="">{{ trans('blog::post.post_title') }}</label>
                                                <input type="text" name="post_title_{{ $key }}" required class="form-control" value="{{ $item->post_title }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ trans('blog::post.post_slug') }}</label>
                                                <input type="text" name="post_slug_{{ $key }}" readonly class="form-control" value="{{ $item->post_slug }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ trans('blog::post.post_excerpt') }}</label>
                                                <textarea id="" name="post_excerpt_{{ $key }}" id="" class="form-control" cols="30" rows="10">{{ $item->post_excerpt }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('blog::post.post_content') }}</label>
                                                <textarea id="" name="post_content_{{ $key }}" id="" class="form-control editor" cols="30" rows="10">{{ $item->post_content }}</textarea>
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label for="">{{ trans('app.meta_title') }}</label>
                                                <input type="text" name="meta_title_{{ $key }}"  class="form-control" value="{{ $item->meta_title }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('app.meta_keyword') }}</label>
                                                <input type="text" name="meta_keyword_{{ $key }}"  class="form-control" value="{{ $item->meta_keyword }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('app.meta_description') }}</label>
                                                <textarea name="meta_description_{{ $key }}"  class="form-control">{{ $item->meta_description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('blog::category.category') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <select name="category_id" class="form-control" id="">
                                    <option value="0">@lang('app.select')</option>
                                    {!! \App\Helpers\NestableRender::renderSelect($cat, $post->category_id ) !!}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('blog::post.post_thumbnail') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select-single-image">
                                    <div class="img-item">
                                        <img width="" class="img-responsive" src="{{ $post->post_thumbnail }}" alt="">
                                        <input type="hidden" value="{{ $post->post_thumbnail }}" name="image" id="" class="form-control ">
                                    </div>
                                    <a href="#">Select Image</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">{{ trans('app.published') }}</div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">{{ trans('app.status') }}</label>
                                <select name="post_status" id="" class="form-control">
                                    <option {{ ($post->post_status == 1) ? 'selected' : ''  }} value="1">{{ trans('app.show') }}</option>
                                    <option {{ ($post->post_status == 0) ? 'selected' : ''  }} value="0">{{ trans('app.hide') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fa fa-save"></i> {{ trans('app.save') }}</button>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('post.index') }}" class="btn btn-info btn-block"><i class="fa fa-refresh"></i> {{ trans('app.back') }}</a>
                            </div>


                        </div>
                    </div>


                </div>
            </div>


        </form>

        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop

