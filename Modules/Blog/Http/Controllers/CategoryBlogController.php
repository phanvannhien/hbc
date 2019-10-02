<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogCategory;
use App\Helpers\Nestable;
use Modules\Blog\Entities\BlogCategoryTrans;
use Modules\Blog\Entities\Post;
use Validator;
use LaravelLocalization;
use Str;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categoryBlog = BlogCategory::get_cat();
        $nest = new Nestable($categoryBlog);
        $cat_blog = $nest->make_category();
        return view('blog::categories.index',compact('cat_blog'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['category_name_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $category = new BlogCategory();
        $category->category_image = $request->input('image');
        $category->category_status = $request->input('category_status');
        $category->parent_id = $request->input('parent_id');

        if(  $request->input( 'parent_id' ) == 0 ){
            $category->category_level = 0;
            $category->category_order = 0;
        }else{
            $parentCate = BlogCategory::findOrFail( $request->input( 'parent_id' ) );
            $category->category_level = $parentCate->category_level + 1;
            $category->category_order = $parentCate->category_order + 1;
        }

        $category->save();

        if( $category ){
            $arrTrans = array();
            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                $arrTrans[] = new BlogCategoryTrans(array(
                    'category_id' => $category->category_id ,
                    'category_name' => $request->input('category_name_'.$key ),
                    'category_slug' => str_slug($request->input('category_name_'.$key )),
                    'category_description' => $request->input('category_description_'.$key ),
                    'language' => $key
                ));
            }

            $category->trans()->saveMany( $arrTrans );
        }


        if( $category ){
            return back()->with('status', trans('app.success') );
        }
        return back()->with('status', trans('app.insert_error') );
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($category_id)
    {
        $category = BlogCategory::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        $category = BlogCategory::findOrFail( $category_id );
        return view('blog::categories.edit',[ 'category' => $category, 'cat' => $cat ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $category_id)
    {
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['category_name_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $category = BlogCategory::findOrFail( $category_id );
        $category->category_image = $request->input('image');
        $category->category_status = $request->input('category_status');
        $category->parent_id = $request->input('parent_id');

        if(  $request->input( 'parent_id' ) == 0 ){
            $category->category_level = 0;
            $category->category_order = 0;
        }else{
            $parentCate = BlogCategory::findOrFail( $request->input( 'parent_id' ) );
            $category->category_level = $parentCate->category_level + 1;
            $category->category_order = $parentCate->category_order + 1;
        }

        $category->save();

        if( $category ){

            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                BlogCategoryTrans::where('language', $key)
                    ->where('category_id', $category->id)
                    ->update(array(
                        'category_id' => $category->id ,
                        'category_name' => $request->input('category_name_'.$key ),
                        'category_slug' => str_slug($request->input('category_name_'.$key )),
                        'category_description' => $request->input('category_description_'.$key ),
                        'language' => $key
                    ));
            }

        }


        if( $category ){
            return back()->with('status', trans('app.success') );
        }
        return back()->with('status', trans('app.insert_error') );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {

    }


    public function frontCategory(Request $request, $category_slug, $category_id){
        $category = BlogCategory::findOrFail($category_id);
        $posts = Post::where('category_id', $category_id)->orderBy('created_at','DESC')->paginate(10);
        return view('blog.category', compact('posts','category'));
    }


    public function frontPost(Request $request, $post_slug, $post_id){
        $post = Post::findOrFail($post_id);
        $post_related = Post::where('category_id', $post->category_id)
            ->where('id','!=', $post->id )
            ->orderBy('created_at','DESC')->limit(5)->get();


        return view('blog.post', compact('post','post_related'));
    }
}
