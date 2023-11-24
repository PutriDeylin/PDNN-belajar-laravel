<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name as category_name');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('products.product_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_categories.category_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $products = $query->paginate(5);

        $startNumber = ($products->currentPage() - 1) * $products->perPage() + 1;

        return view('pages.product', compact('products', 'startNumber'));
    }

    public function create()
    {
        $categories = DB::table('product_categories')->pluck('category_name', 'id');
        return view('pages.addProduct', compact('categories'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'description' => 'required',
            'is_active' => 'nullable|in:on',
            'price' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'stock' => 'required|numeric',
            'unit' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {

            $is_active = $request->has('is_active') == "on" ? 1 : 0;

            $images = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . now()->micro . '.' . $image->getClientOriginalExtension();

                    while (Storage::exists('public/image/' . $imageName)) {
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    }

                    $image->storeAs('public/image', $imageName);
                    $images[] = $imageName;
                }
            }

            DB::table('products')->insert([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'category_id' => $request->category,
                'description' => $request->description,
                'is_active' => $is_active,
                'price' => $request->price,
                'discount_amount' => $request->discount_amount,
                'stock' => $request->stock,
                'unit' => $request->unit,
                'image' => json_encode($images),
            ]);

            return redirect()->route('products')
                ->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('products.create')
                ->with('error', 'Error creating product: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {

        $product = Product::findOrFail($id);

        $categories = DB::table('product_categories')->pluck('category_name', 'id');

        return view('pages.editProduct', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'description' => 'required',
            'is_active' => 'nullable|in:on',
            'price' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'stock' => 'required|numeric',
            'unit' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {

            $is_active = $request->has('is_active') ? 1 : 0;

            $images = [];

            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();

                    while (Storage::exists('public/image/' . $imageName)) {
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    }

                    $image->storeAs('public/image', $imageName);
                    $images[] = $imageName;
                }

                DB::table('products')->where('id', $id)->update(['image' => json_encode($images)]);
            }

            $product = Product::findOrFail($id);
            $product->update([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'category_id' => $request->category,
                'description' => $request->description,
                'is_active' => $is_active,
                'price' => $request->price,
                'discount_amount' => $request->discount_amount,
                'stock' => $request->stock,
                'unit' => $request->unit,

            ]);

            return redirect()->route('products')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('products.edit', $id)->with('error', 'Error updating product: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('products')->where('id', $id)->delete();

            return redirect()->route('products')
                ->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('products')
                ->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
