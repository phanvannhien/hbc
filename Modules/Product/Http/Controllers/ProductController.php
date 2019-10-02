<?php

namespace Modules\Product\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mockery\Exception;
use Modules\Product\Entities\ProductAttributes;
use Modules\Product\Entities\Products;
use Modules\Product\Http\Filters\ProductFilter;

use Validator;
use DB;
use Excel;
use App\Helpers\Nestable;

use App\Exports\ProductExport;
use Storage;
use Modules\Product\Entities\CategoryProducts;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, ProductFilter $filters)
    {
        $category = CategoryProducts::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();

        if( $request->has('export') ){
            $data = Products::join('product')->filter($filters)->get();
            Excel::create('product', function($excel) use ($data) {
                $excel->sheet('Sheetname', function($sheet) use($data) {
//
                    $data = $data->toArray();
//                    dd($data['data']);
//                    array_forget( $data );

                    $sheet->fromArray($data);

                });
            })->download('csv');
            return;
        }else{
            $data = Products::filter($filters)
                ->select('products.id','product_image','product_code','product_cas','product_name','category_id','brand')
                ->orderBy('product_name')
                ->paginate();
        }


        return view('product::products.index',['data' => $data, 'cat' => $cat ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $category = CategoryProducts::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        return view('product::products.create', compact( 'cat' ));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $rules = array(
            'product_code' => 'required:max:255',
            'product_cas' => 'required:max:255',
            'product_name' => 'required:max:255',
        );


        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $product = new Products();
        $product->category_id = $request->input('product_category');
        $product->product_code = $request->input('product_code');
        $product->product_cas = $request->input('product_cas');
        $product->product_type = $request->input('product_type');
        $product->product_name = $request->input('product_name');
        $product->product_synonym = $request->input('product_synonym');
        $product->product_slug = str_slug( $request->input('product_code'));
        $product->product_grade = $request->input('product_grade');
        $product->product_concentration = $request->input('product_concentration');
        $product->product_formular = $request->input('product_formular');
        $product->product_weight = $request->input('product_weight');
        $product->product_tolerance = $request->input('product_tolerance');
        $product->product_neck_size = $request->input('product_neck_size');
        $product->product_material = $request->input('product_material');
        $product->brand = $request->input('brand');
        $product->product_image = $request->input('product_image');
        $product->product_status = $request->input('product_status');
        $product->product_description = $request->input('product_description');
        $product->country_of_origin = $request->input('country_of_origin');


        try{
            DB::beginTransaction();
            $product->save();
            $arrAttr = [];
            foreach ( $request->input('product_attribute') as $attr ){
                $arrAttr[] = new ProductAttributes(array(
                    'product_id' => $product->id ,
                    'attribute_id' => $attr['product_attribute_code'],
                    'attribute_value' => $attr['attribute_value'],
                    'accuracy' => $attr['accuracy'],
                    'neck_size' => $attr['neck_size'],
                    'price' => $attr['product_price'],
                    'sku' => $attr['sku'],
                    'availability' => $attr['availability'],


                ));
            }

            $product->attributes()->saveMany( $arrAttr );

            DB::commit();


            if( $product ){
                return redirect()->route('products.edit', $product->id )
                    ->with('status', trans('global.success') );
            }


        }catch ( Exception $e ){
            DB::rollBack();
            return back()->with('status', trans('app.insert_error') )->withInput();
        }


    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, $product_id)
    {

        $category = CategoryProducts::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        $product = Products::findOrFail( $product_id );
        return view('product::products.edit', compact('cat','product'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $product_id)
    {
//        dd($request->all());
        $rules = array(
            'product_code' => 'required:max:255',
            'product_cas' => 'required:max:255',
            'product_name' => 'required:max:255',
        );


        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $product = Products::findOrFail( $product_id );
        $product->category_id = $request->input('product_category');
        $product->product_code = $request->input('product_code');
        $product->product_cas = $request->input('product_cas');
        $product->product_type = $request->input('product_type');
        $product->product_name = $request->input('product_name');
        $product->product_synonym = $request->input('product_synonym');
        $product->product_slug = str_slug( $request->input('product_code'));
        $product->product_grade = $request->input('product_grade');
        $product->product_concentration = $request->input('product_concentration');
        $product->product_formular = $request->input('product_formular');
        $product->product_weight = $request->input('product_weight');
        $product->product_tolerance = $request->input('product_tolerance');
        $product->product_neck_size = $request->input('product_neck_size');
        $product->product_material = $request->input('product_material');
        $product->brand = $request->input('brand');
        $product->product_image = $request->input('product_image');
        $product->product_status = $request->input('product_status');
        $product->product_description = $request->input('product_description');
        $product->country_of_origin = $request->input('country_of_origin');
        try{
            DB::beginTransaction();
            $product->save();
            $arrAttr = [];

            if( count( $request->input('product_attribute') ) ){

                ProductAttributes::where( 'product_id', $product->id )->delete();

                foreach ( $request->input('product_attribute') as $attr ){
                    $arrAttr[] = new ProductAttributes(array(
                        'product_id' => $product->id ,
                        'attribute_id' => $attr['product_attribute_code'],
                        'attribute_value' => $attr['attribute_value'],
                        'accuracy' => $attr['accuracy'],
                        'neck_size' => $attr['neck_size'],
                        'price' => $attr['product_price'],
                        'sku' => $attr['sku'],
                        'availability' => $attr['availability'],

                    ));
                }

                $product->attributes()->saveMany( $arrAttr );
            }



            DB::commit();


            if( $product ){
                return redirect()->route('products.edit', $product->id )
                    ->with('status', trans('global.success') );
            }


        }catch ( Exception $e ){
            DB::rollBack();
            return back()->with('status', trans('app.insert_error') )->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function export(){
        return Excel::download(new ProductExport, 'product.xlsx');
    }

    public function import(Request $request){


        if ($request->hasFile('file_import')) {

            $file = $request->file( 'file_import' );
            $path = $file->store('imports');
            $filePath = storage_path($path);

            Excel::filter('chunk')->selectSheets(0)->load( $filePath )->chunk(250, function($results)
            {




                foreach($results as $key => $row)
                {


                   if( $row->is_product){




                       $product = Products::where( 'product_code',  $row->product_code )->first();

                       if( !$product ){
                           $product = new Products();
                       }

                       $arrExplode = [
                           'is_product',
                           'product_size',
                           'attribute_value',
                           'price',
                           'product_sku',
                           'availability',
                       ];

                       foreach($row as $key => $value) {
                           if( $value && ! in_array( $key, $arrExplode ) ){
                               $product->$key = $value;
                           }

                       }
                       $product->product_slug = str_slug(  $row->product_name );


                       try{
                           DB::beginTransaction();

                           $product->save();

                           $attr = ProductAttributes::where('product_id', $product->id )
                               ->where('sku', trim($row->product_sku) )->first();

                           if( !$attr ){
                               $attr =  new ProductAttributes();
                           }

                           $attr->product_id =  $product->id;
                           $attr->attribute_id =  $row->product_size;
                           $attr->attribute_value =  $row->attribute_value;
                           $attr->price =  $row->price;
                           $attr->sku =  $row->product_sku;
                           $attr->availability =  $row->availability;
                           $attr->save();

                           DB::commit();

                       }catch ( Exception $e ){
                           DB::rollBack();
                       }
                       echo 'Imported:'.$product->product_name.'<br/>';
                   }else{

                        $product = Products::where( 'product_code',  trim($row->product_code) )->first();

                        if( $product ){

                            $attr = ProductAttributes::where('product_id', $product->id )
                                ->where('sku', trim($row->product_sku) )->first();

                            if( !$attr ){
                                $attr =  new ProductAttributes();
                            }

                            $attr->product_id =  $product->id;
                            $attr->attribute_id =  $row->product_size;
                            $attr->attribute_value =  $row->attribute_value;
                            $attr->price =  $row->price;
                            $attr->sku =  $row->product_sku;
                            $attr->availability =  $row->availability;
                            $attr->save();

                        }

                   }
                   

                }// end foreach
            });
            //return back()->with('status', 'Done');
        }
        return back()->with('status', 'File not found');

    }
}
