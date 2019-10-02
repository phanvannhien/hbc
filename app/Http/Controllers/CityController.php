<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index( Request $request ){
        $data = Cities::orderBy('city_name')
            ->select('city_name','code as city_code','published','country_code','is_default')
            ->paginate(20);
        return view('admin.systems.cities.index', ['data' => $data ]);
    }
}
