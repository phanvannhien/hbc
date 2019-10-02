
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('product::product.product')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <form action="{{ route('products.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_code')*</label>
                                        <input type="text" name="product_code" class="form-control" required value="{{ old('product_code') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_cas')</label>
                                        <input type="text" name="product_cas" class="form-control" required value="{{ old('product_cas') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.brand')</label>
                                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('product::product.product_name')</label>
                                <input type="text" name="product_name" class="form-control" required value="{{ old('product_name') }}" >
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_synonym')</label>
                                        <input type="text" name="product_synonym" class="form-control" value="{{ old('product_synonym') }}" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_grade')</label>
                                        <input type="text" name="product_grade" class="form-control" value="{{ old('product_grade') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_concentration')</label>
                                        <input type="text" name="product_concentration" class="form-control" value="{{ old('product_concentration') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_formular')</label>
                                        <input type="text" name="product_formular" class="form-control" value="{{ old('product_formular') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_tolerance')</label>
                                        <input type="text" name="product_tolerance" class="form-control" value="{{ old('product_tolerance') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_neck_size')</label>
                                        <input type="text" name="product_neck_size" class="form-control" value="{{ old('product_neck_size') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_weight')</label>
                                        <input type="text" name="product_weight" class="form-control" value="{{ old('product_weight') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">@lang('product::product.product_material')</label>
                                        <input type="text" name="product_material" class="form-control" value="{{ old('product_material') }}">
                                    </div>
                                </div>
                            </div>




                            
                            <div class=" form-group">
                                <label for="">@lang('product::product.product_attribute')</label>
                                <div class="attribute-groups">


                                    @if( old('product_attribute') )
                                        <?php $i = 0 ;  ?>
                                        @foreach( old('product_attribute') as $attr )
                                            <div id="" class="row attribute-items" data-row="{{ $i  }}" style="margin-bottom: 10px">
                                                <div class="col-md-2">
                                                    <select name="product_attribute[{{ $i  }}][product_attribute_code]" class="form-control product-code" id="">
                                                        @foreach( \Modules\Product\Entities\Attributes::all() as $item )
                                                            <option value="{{ $item->product_attribute_code }}">{{ $item->product_attribute_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" value="{{ $attr['attribute_value'] }}" name="product_attribute[{{ $i  }}][attribute_value]" class="form-control product-value" placeholder="@lang('product::product.attribute_value')">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" value="{{ $attr['product_price'] }}" name="product_attribute[{{ $i  }}][product_price]" class="form-control product-price" placeholder="@lang('product::product.product_price')">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="{{ $attr['sku'] }}" class="form-control product-sku" placeholder="@lang('product::product.sku')">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="{{ $attr['availability'] }}" class="form-control product-availability" placeholder="@lang('product::product.availability')">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text"  value="{{ $attr['accuracy'] }}"
                                                           name="product_attribute[{{ $i  }}][accuracy]" class="form-control product-accuracy" placeholder="@lang('product::product.accuracy')">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text"  value="{{ $attr['neck_size'] }}"
                                                           name="product_attribute[{{ $i  }}][neck_size]" class="form-control product-neck_size" placeholder="@lang('product::product.neck_size')">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-success btn-add" >
                                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                                <?php $i++ ;?>
                                        @endforeach

                                    @else
                                        <div id="" class="row attribute-items" data-row="0" style="margin-bottom: 10px">
                                            <div class="col-md-2">
                                                <select name="product_attribute[0][product_attribute_code]" class="form-control product-code" id="">
                                                    @foreach( \Modules\Product\Entities\Attributes::all() as $item )
                                                        <option value="{{ $item->product_attribute_code }}">{{ $item->product_attribute_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="product_attribute[0][attribute_value]" class="form-control product-value" placeholder="@lang('product::product.attribute_value')">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="product_attribute[0][product_price]" class="form-control product-price" placeholder="@lang('product::product.product_price')">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="product_attribute[0][sku]" class="form-control product-sku" placeholder="@lang('product::product.sku')">
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" name="product_attribute[0][availability]" class="form-control product-availability" placeholder="@lang('product::product.availability')">
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text"  value=""
                                                       name="product_attribute[0][accuracy]" class="form-control product-accuracy" placeholder="@lang('product::product.accuracy')">
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text"  value=""
                                                       name="product_attribute[0][neck_size]" class="form-control product-neck_size" placeholder="@lang('product::product.neck_size')">
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success btn-add" >
                                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('product::product.product_description')</label>
                                <textarea name="product_description" id="" class="form-control editor" cols="30" rows="10"></textarea>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('product::categories.category') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <select name="product_category" class="form-control" id="">
                                    <option value="0">@lang('app.select')</option>
                                    {!! \App\Helpers\NestableRender::renderSelect($cat) !!}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('product::product.product_type') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <select name="product_type" class="form-control" id="">
                                
                                    <option {{ (old('product_type') == 'hoachat') ? 'selected' : '' }} value="hoachat">hoachat</option>
                                    <option {{ (old('product_type') == 'chatchuan') ? 'selected' : '' }} value="chatchuan">chatchuan</option>
                                    <option {{ (old('product_type') == 'dungcu') ? 'selected' : '' }} value="dungcu">dungcu</option>
                                    <option {{ (old('product_type') == 'thietbi') ? 'selected' : '' }} value="thietbi">thietbi</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('product::product.product_image') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select-single-file">
                                    <div class="img-item">
                                        <img width="" class="img-responsive" src="{{ old('product_name') }}" alt="">
                                        <input type="hidden" value="{{ old('product_name') }}" name="product_image" id="" class="form-control ">
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
                                <select name="product_status" id="" class="form-control">
                                    <option {{ (old('product_status') == 1) ? 'selected':'' }} value="1">{{ trans('app.show') }}</option>
                                    <option value="0">{{ trans('app.hide') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fa fa-save"></i> {{ trans('app.save') }}</button>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('products.index') }}" class="btn btn-info btn-block"><i class="fa fa-refresh"></i> {{ trans('app.back') }}</a>
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
@include('ckfinder::setup')
@section('footer')
    <script>
        $('.select-single-file').on('click', function(){
            selectFileWithCKFinder( this );
        })


        $(document).on('click', '.btn-add', function(e)
        {
            e.preventDefault();

            var controlForm = $('.attribute-groups'),
                currentEntry = $(this).parents('.attribute-items:last'),
                newEntry = $(currentEntry.clone());

            var num = parseInt( $(currentEntry).attr('data-row') ) + 1;
            $(newEntry).attr('data-row',num);

            newEntry.find('.product-code').attr('name','product_attribute['+num+'][product_attribute_code]');
            newEntry.find('.product-value').attr('name','product_attribute['+num+'][attribute_value]').val('');
            newEntry.find('.product-price').attr('name','product_attribute['+num+'][product_price]').val('');
            newEntry.find('.product-sku').attr('name','product_attribute['+num+'][sku]').val('');
            newEntry.find('.product-availability').attr('name','product_attribute['+num+'][availability]').val('');

            newEntry.appendTo(controlForm);


            controlForm.find('.btn-add:not(:last)')
                .removeClass('btn-default').addClass('btn-danger')
                .removeClass('btn-add').addClass('btn-remove')
                .html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>');
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.attribute-items:first').remove();
            e.preventDefault();
            return false;
        });


        function selectFileWithCKFinder( elementId ) {
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        console.log( file );
                        var img = jQuery( elementId ).find('img');
                        var fileinput = jQuery( elementId ).find('input[name="product_image"]');
                        $(img).attr('src', file.getUrl() );
                        $( fileinput ).val( file.getUrl() );

                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.value = evt.data.resizedUrl;
                    } );
                }
            } );
        }
    </script>
@stop