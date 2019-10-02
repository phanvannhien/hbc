<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Contact;
use Auth;

class ContactController extends Controller
{
    public function index(){
        $data = Contact::paginate();
        return view('admin.systems.contact.index', compact('data'));
    }
}