<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostTrans;
use Modules\Blog\Http\Filters\PostFilter;
use App\Helpers\Nestable;

use LaravelLocalization;
use Validator;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index( Request $request, PostFilter $filter )
    {

        $category = BlogCategory::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();


        $data = Post::join('post_trans','posts.id','=','post_trans.post_id')
            ->where('language', app()->getLocale() )
            ->filter($filter)->select( 'posts.id','post_type','post_status','post_title')
            ->paginate(20);

        return view('blog::post.index',['data' => $data, 'cat' => $cat ]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $category = BlogCategory::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        return view('blog::post.create',['cat' => $cat ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['post_title_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $post = new Post();
        $post->post_status = $request->input('post_status');
        $post->post_thumbnail = $request->input('image');
        $post->category_id = $request->input('category_id');
        $post->created_by = Auth::user()->id;
        $post->save();



        if( $post ){
            $arrTrans = array();
            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                $arrTrans[] = new PostTrans(array(
                    'post_content' => $request->input('post_content_'.$key ),
                    'post_title' => $request->input('post_title_'.$key ),
                    'post_slug' => str_slug( $request->input('post_title_'.$key ) ),
                    'post_excerpt' => $request->input('post_excerpt_'.$key ),
                    'meta_title' => $request->input('meta_title_'.$key ),
                    'meta_keyword' => $request->input('meta_keyword_'.$key ),
                    'meta_description' => $request->input('meta_description_'.$key ),
                    'language' => $key
                ));
            }

            $post->trans()->saveMany( $arrTrans );
        }


        if( $post ){
            return redirect()->route('post.edit', $post->id )
                ->with('status', trans('global.success') );
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
    public function edit($post_id)
    {
        $category = BlogCategory::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        $post = Post::findOrFail( $post_id );


        return view('blog::post.edit', compact('post','cat'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $post_id)
    {
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['post_title_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $post = Post::findOrFail( $post_id );
        $post->post_status = $request->input('post_status');
        $post->post_thumbnail = $request->input('image');
        $post->category_id = $request->input('category_id');
        $post->created_by = Auth::user()->id;
        $post->save();


        if( $post ){
            $arrTrans = array();
            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                PostTrans::where('language', $key)->where('post_id', $post->id )
                    ->update(
                        array(
                            'post_content' => $request->input('post_content_'.$key ),
                            'post_title' => $request->input('post_title_'.$key ),
                            'post_slug' => str_slug( $request->input('post_title_'.$key ) ),
                            'post_excerpt' => $request->input('post_excerpt_'.$key ),
                            'meta_title' => $request->input('meta_title_'.$key ),
                            'meta_keyword' => $request->input('meta_keyword_'.$key ),
                            'meta_description' => $request->input('meta_description_'.$key ),
                            'language' => $key
                        )
                    );
            }

        }


        if( $post ){
            return redirect()->route('post.edit', $post->id )
                ->with('status', trans('global.success') );
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
}
