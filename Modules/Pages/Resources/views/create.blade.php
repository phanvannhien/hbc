
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pages
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <form action="{{ route('pages.store') }}" method="POST">
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
                                        <div class="tab-pane {{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}" id="tab_{{ $key }}">
                                            <div class="form-group">
                                                <label for="">{{ trans('pages::pages.title') }}</label>
                                                <input type="text" name="title_{{ $key }}" required class="form-control" value="{{ old('title_'.$key ) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('pages::pages.slug') }}</label>
                                                <input type="text" name="slug_{{ $key }}" required class="form-control" value="{{ old('slug_'.$key ) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('pages::page.content') }}</label>
                                                <textarea id="" name="content_{{ $key }}" id="" class="form-control editor" cols="30" rows="10">{{ old('content_'.$key ) }}</textarea>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="">{{ trans('app.meta_title') }}</label>
                                                <input type="text" name="meta_title_{{ $key }}"  class="form-control" value="{{ old('meta_title_'.$key ) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('app.meta_keyword') }}</label>
                                                <input type="text" name="meta_keyword_{{ $key }}"  class="form-control" value="{{ old('meta_keyword_'.$key ) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ trans('app.meta_description') }}</label>
                                                <textarea name="meta_description_{{ $key }}"  class="form-control">{{ old('meta_description_'.$key ) }}</textarea>
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
                        <div class="box-header">{{ trans('app.published') }}</div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">{{ trans('app.status') }}</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">{{ trans('app.show') }}</option>
                                    <option value="0">{{ trans('app.hide') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fa fa-save"></i> {{ trans('app.save') }}</button>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('pages.index') }}" class="btn btn-info btn-block"><i class="fa fa-refresh"></i> {{ trans('app.back') }}</a>
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

@section('footer')
    <script>

//            .each(function(e){
//            CKEDITOR.replace( this.id, {
//                filebrowserBrowseUrl: '/ckfinder/browser',
//                filebrowserUploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files',
//                filebrowserWindowWidth: '1000',
//                filebrowserWindowHeight: '700'
//            });
//        });


    </script>
@stop