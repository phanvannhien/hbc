<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function index(){
        $data = Languages::orderBy('active','DESC')->select('code as language_code','name','active')->paginate(10);

        return view('admin.systems.languages.index', [ 'data' =>$data  ]);
    }
}
