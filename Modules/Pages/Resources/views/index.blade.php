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
        <p class="clearfix">
            <a href="{{ route('pages.create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> @lang('app.create')</a>
        </p>
        <form action="" class="form-inline">
            <div class="form-group">
                <input type="text" name="title" value="{{ Request::get('title') }}" class="form-control">
            </div>
            <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
        </form>
        <p> </p>

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
               <table class="table">
                    <thead>
                        <tr>
                            <td>{{ trans('pages::pages.title') }}</td>
                            <td>{{ trans('pages::pages.status') }}</td>
                            <td>{{ trans('app.actions') }}</td>
                        </tr>
                    </thead>
                   <tbody>
                        @foreach( $pages as $page )


                            <tr>
                                <td>
                                    {{ link_to_route('pages.edit', $page->title, array('id'=>$page->id) ) }}
                                </td>
                                <td><span class="label {{ ($page->status == 1) ? 'label-success' : 'label-warning' }}">
                                        {{ ($page->status == 1) ?  trans('app.show')  : trans('app.hide') }}
                                    </span></td>

                                <td>
                                    <div class="btn-group">
                                        <a target="_blank" class="btn btn-success btn-sm" href="{{ route('page.single', [ 'page_slug' => $page->slug, 'page_id' => $page->id  ]) }}">
                                            <i class="fa fa-eye"></i> @lang('app.view')
                                        </a>
                                        <a href="{{ route('pages.edit', $page->id ) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                   </tbody>
               </table>
            </div>

        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop
