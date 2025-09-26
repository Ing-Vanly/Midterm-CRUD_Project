<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalproduct = \App\Models\Product::count();
        $totalcategory = \App\Models\Category::count();
        $totaluser = \App\Models\User::count();
        $totalrole = Role::count();
        return view('admin.index', compact('totalproduct', 'totalcategory', 'totaluser', 'totalrole'));
    }
}
