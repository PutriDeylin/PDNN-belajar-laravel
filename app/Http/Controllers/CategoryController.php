<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        DB::table('product_categories')->insert([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('pages.category')
            ->with('success', 'Product created successfully.');
    }

    public function getCategories()
    {
        $categories = DB::table('product_categories')->pluck('category_name', 'id');
        return view('pages.addproduct', compact('categories'));
    }

}
