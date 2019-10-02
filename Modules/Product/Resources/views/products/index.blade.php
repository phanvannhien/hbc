@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('product::product.products')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-sm-6">
                <form action="{{ route('products.import') }}" class="form-inline" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" class="form-control" name="file_import">
                    <button class="btn btn-primary" type="submit">@lang('app.import')</button>
                </form>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('products.create') }}" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i> @lang('app.create')</a>
            </div>
        </div>


        <form action="" class="form-inline">
            <div class="form-group">
                <input type="text" name="product_name" value="{{ Request::get('product_name') }}" class="form-control" placeholder="@lang('product::product.product_name')">
                <input type="text" name="product_code" value="{{ Request::get('product_code') }}" class="form-control" placeholder="@lang('product::product.product_code')">
                <input type="text" name="product_cas" value="{{ Request::get('product_cas') }}" class="form-control" placeholder="@lang('product::product.product_cas')">
                <input type="text" name="product_sku" value="{{ Request::get('product_sku') }}" class="form-control" placeholder="@lang('product::product.product_sku')">
                <input type="text" name="brand" value="{{ Request::get('brand') }}" class="form-control" placeholder="@lang('product::product.brand')">
                <select name="category_id" class="form-control" id="">
                    <option value="">@lang('app.select')</option>
                    {!! \App\Helpers\NestableRender::renderSelect($cat, Request::get('category_id') ) !!}
                </select>
            </div>
            <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
            <button type="submit" value="export" name="export" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> {{ trans('app.export') }}</button>

        </form>
        <p> </p>

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('product::product.product_image') }}</td>
                        <td>{{ trans('product::product.product_code') }}</td>
                        <td>{{ trans('product::product.product_name') }}</td>
                        <td>{{ trans('product::product.product_cas') }}</td>
                        <td>{{ trans('product::product.brand') }}</td>
                        <td>{{ trans('product::categories.category') }}</td>
                        <td>{{ trans('app.actions') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <?php
                            if( $item->category_id != 0){
                                $category = $item->category->get_trans();
                            }
                        ?>
                        <tr>
                            <td><img src="{{ $item->product_image }}" width="50" alt=""></td>
                            <td>{{ $item->product_code }}</td>
                            <td><a href="{{ route('products.edit', $item->id ) }}">{{ $item->product_name }}</a></td>
                            <td>{{ $item->product_cas }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>
                                @if( $item->category_id != 0)
                                <a href="{{ route('categories.edit', $category->id) }}">{{ $category->category_name }}</a></td>
                                @endif
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('products.edit', $item->id ) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                    <a href="{{ route('products.destroy', $item->id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> {{ trans('app.delete') }}</a>
                                    <a data-toggle="collapse" href="#collapse{{ $item->id }}" class="btn btn-sm btn-success  ">
                                        <i class="fa fa-search"></i> {{ trans('app.view_more') }}</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="collapse" id="collapse{{ $item->id }}">
                                    <table class="table table-bordered">
                                        <tr style="background: #eee">
                                            <td>@lang('product::product.attribute_id')</td>
                                            <td>@lang('product::product.attribute_value')</td>
                                            <td>@lang('product::product.sku')</td>
                                            <td>@lang('product::product.price')</td>
                                            <td>@lang('product::product.availability')</td>
                                        </tr>
                                        @foreach( $item->attributes as $attr )
                                            <tr>
                                                <td>{{ $attr->attribute_id }}</td>
                                                <td>{{ $attr->attribute_value }}</td>
                                                <td>{{ $attr->sku }}</td>
                                                <td class="text-danger">{{ $attr->getPriceFormat() }}</td>
                                                <td>{{ $attr->availability }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
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
