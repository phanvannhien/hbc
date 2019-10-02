@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('product::customer.customer') </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <p class="clearfix">
            <a href="{{ route('customer.create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> @lang('app.create')</a>
        </p>
        <form action="" class="form-inline">
            <div class="form-group">

                <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" placeholder="name">
            </div>
            <div class="form-group">
                <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="email...">
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
                        <td>{{ trans('product::customer.name') }}</td>
                        <td>{{ trans('product::customer.email') }}</td>
                        <td>{{ trans('product::customer.phone') }}</td>
                        <td>{{ trans('app.actions') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td><a href="#">{{ $item->name }}</a></td>
                            <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                            <td><a href="tel:{{ $item->phone }}">{{ $item->phone }}</a></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('customer.edit', $item->id ) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                    <a href="{{ route('customer.destroy', $item->id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> {{ trans('app.delete') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <div class="box-footer text-center">
                        <div class="clearfix">
                            @if( $data && count($data))
                                <p class="text-right">@lang('app.showing') {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
                                    @lang('app.results')</p>
                            @endif
                        </div>

                    </div>
                </table>
            </div>

        </div>
        <!-- /.box -->
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop
