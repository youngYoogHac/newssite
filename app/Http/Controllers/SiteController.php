<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SiteController extends Controller
{
    public function main(): View
    {
        return view('main');
    }

    public function category(): View
    {
        return view('category');
    }

    public function journalist(): View
    {
        return view('journalist');
    }

    public function admin(): View
    {
        return view('admin');
    }
}
