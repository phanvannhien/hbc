@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('blog::post.post')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <p class="clearfix">
            <a href="{{ route('post.create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> @lang('app.create')</a>
        </p>
        <form action="" class="form-inline">
            <div class="form-group">
                <input type="text" name="post_title" value="{{ Request::get('post_title') }}" class="form-control">
            </div>
            <button type="submit" value="filter" name="filter" class="btn btn-primary">
                <i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
        </form>
        <p> </p>

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('blog::post.post_title') }}</td>
                        <td>{{ trans('blog::post.post_status') }}</td>
                        <td>{{ trans('app.actions') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td>
                                <a href="{{ route('post.edit', $item->id) }}">{{ $item->post_title }}</a>
                            </td>
                            <td><span class="label {{ ($item->post_status == 1) ? 'label-success' : 'label-warning' }}">
                                    {{ ($item->post_status == 1) ?  trans('app.show')  : trans('app.hide') }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('post.edit', $item->id ) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                    <a href="{{ route('post.destroy', $item->id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> {{ trans('app.delete') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-center">
                <div class="clearfix">
                    @if( $data && count($data))
                        <p class="text-right">@lang('app.showing') {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
                            @lang('app.results')</p>
                    @endif
                </div>

            </div>

        </div>
        <!-- /.box -->
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop
