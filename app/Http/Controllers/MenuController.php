<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;
use Validator;



class MenuController extends Controller
{
    public function index(){
        return view('admin.systems.menus.index');

    }

    public function create (){
        return view('admin.systems.menus.create');
    }

    public function store(Request $request){
        $rules = array(
            'menu_code' => 'required:max:255|alpha_dash',
            'menu_title' => 'required|max:255'
        );
        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $menu = new Menus();
        $menu->menu_code = $request->input('menu_code');
        $menu->menu_title = $request->input('menu_title');
        $menu->save();

        return redirect()->route('menus.edit', $menu->id )
            ->with('status', trans('global.success') );

    }

    public function edit(Request $request, $menu_id){
        $menu = Menus::findOrFail($menu_id);
        return view('admin.systems.menus.edit', compact('menu'));
    }


}
