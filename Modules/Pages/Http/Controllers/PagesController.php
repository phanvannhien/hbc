<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Pages\Entities\Page;

use Modules\Pages\Entities\PageTrans;
use Modules\Pages\Http\Filters\PageFilters;
use Validator;
use LaravelLocalization;


class PagesController extends Controller
{

    private $table = 'pages';
    private $table_trans = 'pages_trans';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, PageFilters $filters)
    {
        $pages = Page::join('pages_trans','pages.id','=','pages_trans.page_id')
            ->where('language', app()->getLocale() )
            ->filter($filters)->select( 'pages.id','status','title','slug')->paginate(20);
        return view('pages::index',[ 'pages' => $pages ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pages::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['title_'.$key ] = 'required';
            $rules['slug_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $page = new Page();
        $page->status = $request->input('status');
        $page->save();



        if( $page ){
            $arrStoresTrans = array();
            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                $arrStoresTrans[] = new PageTrans(array(
                    'content' => $request->input('content_'.$key ),
                    'title' => $request->input('title_'.$key ),
                    'slug' => $request->input('slug_'.$key ),
                    'meta_title' => $request->input('meta_title_'.$key ),
                    'meta_keyword' => $request->input('meta_keyword_'.$key ),
                    'meta_description' => $request->input('meta_description_'.$key ),
                    'language' => $key
                ));
            }

            $page->trans()->saveMany( $arrStoresTrans );
        }


        if( $page ){
            return redirect()->route('pages.edit', $page->id )
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
        return view('pages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit( $page_id )
    {
        $page = Page::findOrFail( $page_id );
        return view('pages::edit',[ 'page' => $page ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $page_id )
    {


        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['title_'.$key ] = 'required';
            $rules['slug_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }


        try{

            $page = Page::findOrFail( $page_id );
            $page->status = $request->input('status');
            $page->save();
            if( $page ){


                foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){

                    PageTrans::where('language', $key)->where('page_id', $page->id )
                        ->update(
                            array(
                                'content' => $request->input('content_'.$key ),
                                'title' => $request->input('title_'.$key ),
                                'slug' => $request->input('slug_'.$key ),
                                'meta_title' => $request->input('meta_title_'.$key ),
                                'meta_keyword' => $request->input('meta_keyword_'.$key ),
                                'meta_description' => $request->input('meta_description_'.$key ),
                            )
                        );



                }



            }


            if( $page ){
                return redirect()->route('pages.edit', $page->id )
                    ->with('status', trans('global.success') );
            }


        }catch(\Exception $e){
            //failed logic here

            throw $e;
        }



    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }


    /**
     *
     */

    public function page( $page_slug, $page_id ){
        return view('pages.page', [ 'page' => Page::findOrFail( $page_id )  ]);
    }
}
