<?php

namespace App\Http\Controllers;

use App\Helpers\Nestable;
use App\Models\Contact;
use Illuminate\Http\Request;
use Modules\Product\Entities\CategoryProducts;
use Modules\Product\Entities\Products;

use SEOMeta;
use OpenGraph;
use Twitter;
use Validator;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('home');
    }

    public function category(Request $request, $slug, $id){



        $category = CategoryProducts::findOrFail($id);
        $products = new Products();
        if( $request->has('brand') ){
            $products = $products->where('brand', $request->input('brand') );
        }

        $products = $products->where('category_id', $id )->orderBy('product_name')->paginate(20);

        return view('category', compact('products','category'));
    }


    public function product( Request $request, $slug, $id    ){

        $product = Products::findOrFail( $id );
        SEOMeta::setTitle($product->product_name);
        SEOMeta::setDescription($product->name);
        SEOMeta::addMeta('article:published_time', $product->create_at, 'property');
        SEOMeta::addMeta('article:section', $product->category->get_trans()->category_name , 'property');
        SEOMeta::addKeyword($product->product_name);

        OpenGraph::setDescription($product->name);
        OpenGraph::setTitle($product->name);
        OpenGraph::setUrl( $request->path() );
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi-VN');
        OpenGraph::addProperty('locale:alternate', ['en-us']);
        OpenGraph::addImage( $product->product_image );

        // Namespace URI: http://ogp.me/ns/article#
        // article
        OpenGraph::setTitle( $product->name )
            ->setDescription( $product->name )
            ->setType('article')
            ->setArticle([
                'published_time' => $product->created_at,
                'modified_time' => $product->updated_at,
                'expiration_time' => 'datetime',
                'author' => 'nhienphan',
                'section' => 'string',
                'tag' => $product->name
            ]);

        return view('pages.product_detail', compact('product'));

    }


    public function searchSubmit( Request $request){
        if( $request->has('q') )
        $s = $request->input('q');
        $products = Products::where( 'product_name','LIKE', '%'.$s.'%' )
            ->orWhere( 'product_code','LIKE', '%'.$s.'%' )
            ->orWhere( 'product_cas','LIKE', '%'.$s.'%' )
            ->orWhere( 'product_synonym','LIKE', '%'.$s.'%' )
            ->orWhere( 'brand','LIKE', '%'.$s.'%' )
            ->select('products.id','product_slug','product_name')
            ->paginate(30);
        return view('pages.search', compact('products'));
    }

    public function contact(){
        return view('pages.contact');
    }

    public function contact_save(Request $request){
        $validator = Validator::make($request->all(), [
            'your_name' => 'required|max:200|min:3',
            'your_email' => 'required|max:200|min:3',
            'your_subject' => 'required|max:200',
            'your_message' => 'required|max:500'
        ]);

        if ($validator->fails()) {
            return back()->withErrors()->withInput();
        }

        $contact = new Contact();
        $contact->name = $request->input('your_name');
        $contact->email = $request->input('your_email');
        $contact->subject = $request->input('your_subject');
        $contact->message = $request->input('your_message');
        $contact->save();

        return back()->with('status', trans('app.thank_contact'));
    }

    public function compare_item()
    {
        if( Session::has('product_compare') ){
            $products = Products::whereIn('product_code', Session::get('product_compare') )->get();
            return view('pages.compare', compact('products'));
        }
        return back();
    }
}
