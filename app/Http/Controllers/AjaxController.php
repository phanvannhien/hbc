<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Product\Entities\Products;

use Session;

class AjaxController extends Controller
{

    public function search(Request $request){
        if($request->ajax() && $request->has('s') && strlen($request->input('s')) > 3 ){
            $s = $request->input('s');
            $products = Products::where( 'product_name','LIKE', '%'.$s.'%' )
                ->orWhere( 'product_code','LIKE', '%'.$s.'%' )
                ->orWhere( 'product_cas','LIKE', '%'.$s.'%' )
                ->orWhere( 'product_synonym','LIKE', '%'.$s.'%' )
                ->orWhere( 'brand','LIKE', '%'.$s.'%' )
                ->select('products.id','product_slug','product_name')
                ->limit(10)->get();
            return view('ajax.product_search', compact('products'));
        }
    }

    public function compare(Request $request){

        if( $request->ajax() && $request->method('get') ){
            $action = $request->input('action');
            $product_code = $request->input('product_code');
            

            //Session::forget('product_compare');

            if( $action == 'add' ){

                if( Session::has('product_compare') && count( Session::get('product_compare') ) > 3 ){
                    return response()->json( array('success' => false, 'msg' => trans('app.max_compare_items') ));
                }

                if( Session::has('product_compare') ){
                    $arr = Session::get('product_compare');
                    array_push( $arr , $product_code );

                }else{
                    $arr = array();
                    array_push( $arr , $product_code );
                }
                Session::put('product_compare',  $arr);

                
            }else{

                if( Session::has('product_compare') ){
                    $arr = Session::get('product_compare');
                    $key = array_search($product_code, $arr);
                    if($key !== false){
                        unset( $arr[$key]) ;
                    }
                    Session::put('product_compare',  $arr);
                }


            }

            
            return response()->json( array('success' => true, 'msg' => '' ) );
        }
    }



}
