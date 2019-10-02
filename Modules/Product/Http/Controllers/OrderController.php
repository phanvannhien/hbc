<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Order;
use Modules\Product\Http\Filters\OrdersFilter;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, OrdersFilter $filter)
    {
        $data = Order::join('users','orders.user_id','=','users.id')
            ->filter($filter)
            ->orderBy('created_at','DESC')
            ->select( 'orders.id','users.email','users.name','orders.status','orders.created_at')
            ->paginate();
        return view('product::orders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
    public function edit($order_id)
    {
        $order  = Order::findOrFail( $order_id );
        return view('product::orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        return back();
    }

    public function change_status( Request $request ){
        $order = Order::findOrFail( $request->input('order_id') );
        if( $order->status !=  $request->input('status') ){
            $order->status = $request->input('status');
            $order->save();
        }
        return back()->with( 'status','Success' );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
