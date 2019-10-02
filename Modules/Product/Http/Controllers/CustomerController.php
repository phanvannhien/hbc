<?php

namespace Modules\Product\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Order;
use Modules\Product\Entities\UserShippingAddress;
use Modules\Product\Http\Filters\CustomerFilter;
use Auth;use Validator;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, CustomerFilter $filter )
    {
        $data = User::filter($filter)->paginate();
        return view('product::customers.index', compact('data'));
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
    public function edit()
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }


    /**
     * Front-end
     */


    public function profile(){
        return view('product::myaccounts.profile');
    }

    public function profilePost(Request $request){
        $user = Auth::user();

        $rules = [
            'name' => 'required|min:6:max:200',
            'phone' => 'required|min:10|max:12',
            'gender' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->company_name = $request->input('company_name');
        $user->company_address = $request->input('company_address');
        $user->dob = $request->input('day').'-'.$request->input('month').'-'.$request->input('year');

        if($user->save()) {
            return back()->with(['status' => 'Update successful!']);

        }

        return back();
    }


    public function get_form_change_password(){
        return view('product::myaccounts.change_password');
    }

    public function save_change_password (Request $request){
        $user = Auth::user();
        $old_password = $request->input('old_pass');
        if( !empty($old_password) ){
            $rules['password'] = 'required|min:6|max:200|confirmed';
            $validator = Validator::make($request->all(), $rules );
            if ($validator->fails()) {
                return back()->withErrors ( $validator )->withInput();
            }
        }


        if( !empty($old_password) ) {
            $new_password = $request->input('password');
            if (Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($new_password);
            } else {
                return back()->with(['warning' => 'Old password does not math']);
            }
        }

        return back()->with(['warning' => 'Change password fail!']);
    }

    public function order(){
        $orders = Order::where('user_id', Auth::user()->id )->paginate();
        return view('product::myaccounts.orders',['orders' => $orders ]);
    }

    public function order_detail( Request $request, $id ){
        $order = Order::findOrFail( $id );
        return view('product::myaccounts.order_detail', [ 'order' => $order ]);
    }
    public function address_book(){
        $address = UserShippingAddress::where('user_id', Auth::user()->id )->get();
        return view('product::myaccounts.address_book', [ 'address' =>  $address ]);
    }

    public function address_book_detail ($id){
        $address = UserShippingAddress::findOrFail($id);
        return view('product::myaccounts.address_book_edit', [ 'address' =>  $address ]);
    }

    public function address_book_detail_save(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:10|max:20',
            'address' => 'required|max:254',
            'full_name' => 'required|max:254',
        ]);

        if ($validator->fails()) {
            return back()->withErrors( $validator )->withInput();
        }
        $address = UserShippingAddress::findOrFail($id);
        $address->full_name = $request->input('full_name');
        $address->phone = $request->input('phone');
        $address->address = $request->input('address');
        $address->save();

        return back()->with('status',  trans('app.success') );
    }


    public function address_book_delete(Request $request, $id){
        $address = UserShippingAddress::findOrFail($id);
        $address->delete();
        return back()->with('status',  trans('app.success') );

    }

}
