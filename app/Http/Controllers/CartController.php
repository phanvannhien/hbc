<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\UserAddressBook;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cart;
use Mail;
use Mockery\Exception;
use Modules\Product\Entities\UserShippingAddress;
use Validator;
use DB;

use Modules\Product\Entities\Products;
use Modules\Product\Entities\ProductAttributes;
use Modules\Product\Entities\Order;
use Modules\Product\Entities\OrderDetails;

use Illuminate\Support\Facades\Auth;


class CartController extends Controller{


    public function addcart(Request $request){
        if( $request->ajax() && $request->isMethod('post') && $request->has('qty') ){


            foreach ( $request->input('qty') as $sku => $qty ){

                if( $qty > 0 ){
                    $product = ProductAttributes::where('sku', $sku)->first();
                 
                    if( $product ){
                        // check cart item is exitst
                        $cartItem = Cart::get($sku);
                        if( $cartItem ){

                            Cart::update( $sku , array(
                                'quantity' => array(
                                    'relative' => false,
                                    'value' => $qty
                                ),
                            ));
                        }else{ // add new cart item

                            $arr = array(
                                'id' => $product->sku,
                                'name' => $product->parent_product->product_name ,

                                'price' =>  $product->price,
                                'quantity' => (int)$qty,
                                'attributes' => array(
                                    'product_id' => $product->product_id,
                                    'slug' => $product->product_slug,
                                    'image' => $product->product_image,
                                    'attribute_value' => $product->attribute_value,
                                    'availability' => $product->availability,
                                )
                            );
                            Cart::add($arr);
                        }

                    }
                }

            }
            return response()->json([
                'ok' => true,
                'cart_total' => number_format(Cart::getTotal()).config('app.price_suffix'),
                'cart_count' =>  Cart::getTotalQuantity(),
                'msg' => trans( 'product::product.add_cart_success' ) ]);

        }
        return response()->json([
            'ok' => false,
            'msg' => trans( 'product::product.add_cart_fail' ) ]);

    }


    public function viewcart(){
        return view('pages.cart');
    }

    public function ajaxCart(){
        return view('ajax.cart')->render();
    }

    public function updatecart( Request $request){
        //dd($request->all());
        if( $request->isMethod('post') ){

            if( $request->has('action') && $request->input('action') == 'update_cart'  ){
                foreach ( $request->input('quantity') as $key => $qty ){
                    $msg = [];

                    Cart::update( $key , array(
                        'quantity' => array(
                            'relative' => false,
                            'value' => $qty
                        ),
                    ));

                }
                return back()->with('status', trans('product::order.update_success'))->with('warning', $msg );
            }

            if( $request->has('action') && $request->input('action') == 'clean_cart'  ){
                Cart::clear();
                return back()->with('status', trans('product::order.clean_cart_success'));
            }

            if( $request->has('remove') ){
                Cart::remove( $request->input('remove') );
                return back()->with('status', trans('product::order.remove_item_success') );
            }
        }


    }

    public function checkout( Request $request ){
        return view('pages.checkout');
    }

    public function purchase( Request $request ){

        if( $request->isMethod('post') ){

            if( $request->input('address_id') == 0 ){
                $validator = Validator::make($request->all(), [
                    'phone' => 'required|min:10|max:20',
                    'address' => 'required|max:254',
                    'full_name' => 'required|max:254',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors( $validator )->withInput();
                }
                $address = new UserShippingAddress();
                $address->user_id = Auth::user()->id;
                $address->full_name = $request->input('full_name');
                $address->phone = $request->input('phone');
                $address->address = $request->input('address_id');
                $address->save();


            }else{

                $address = UserShippingAddress::findOrFail( $request->input('address_id') );

            }


            try{
                DB::beginTransaction();

                $order = new Order();
                $order->user_id = Auth::id();
                $order->status = 'waiting';
                $order->note = $request->input('note');
                $order->shipping_address = $address->address;
                $order->shipping_phone = $address->phone;
                $order->shipping_fullname = $address->full_name;
                $order->save();



//                $orderHistory = new OrderHistory();
//                $orderHistory->order_id = $order->id;
//                $orderHistory->order_status = 'waiting';
//                $orderHistory->reason = '';
//                $orderHistory->user_type = 'user';
//                if( Auth::check() )
//                    $orderHistory->user_id = Auth::id();
//                else
//                    $orderHistory->user_id = 0;
//                $orderHistory->save();

                // saving detail
                if($order){
                    $arrDetail = array();
                    $cart = Cart::getContent();

                    foreach ($cart as $item) {
                        # code...
                        array_push($arrDetail, array(
                            'order_id' => $order->id ,
                            'product_sku' => $item->id,
                            'product_id' => $item->attributes['product_id'] ,
                            'qty' => $item->quantity,
                            'price' => $item->price,
                            'sub_total' => $item->quantity*$item->price
                        ));
                    }

                    $order->detail()->createMany( $arrDetail );

                    try{
//                        // try
//                        $to = Auth::user()->email ;
//                        Mail::send('emails.order',
//                            array('order' => $order , 'cart' => $cart )
//                            ,function($message) use ( $order , $to ) {
//                                $message->from( config( 'admin_email' ) );
//                                $message->to( $to )
//                                    ->cc( config('admin_email') )
//                                    ->subject( config('app_name').' - Comfirm your order:#'.$order->id );
//                            });
                    }
                    catch(Exception $e){
                        // fail
                    }
                    DB::commit();
                    Cart::clear();
                    //Return checkout success page
                    return redirect()->route( 'checkout.success', $order->id );
                }


            }catch (Exception $e ){
                DB::rollBack();
            }

        }

    }

    public function checkoutSuccess(Request $request, $orderId){
        $order = Order::findOrFail( $orderId );
        return view('pages.checkout_success',array('order' => $order ) );
    }

}
