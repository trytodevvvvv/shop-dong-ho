<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = \App\Models\Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}
