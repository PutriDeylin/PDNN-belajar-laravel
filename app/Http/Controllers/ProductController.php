<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name as category_name');

        // Cek apa ada parameter pencarian
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
        // return view('pages.addproduct');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {

            $images = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/image', $imageName);
                    $images[] = $imageName;
                }
            }

            DB::table('products')->insert([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'category_id' => $request->category,
                'price' => $request->price,
                'image' => json_encode($images),
            ]);

            return redirect()->route('products')
                ->with('success', 'Successfully Added!');
        } catch (\Exception $e) {
            return redirect()->route('products.create')
                ->with('error', 'Error Adding!: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        // Ambil data produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Ambil data kategori untuk dropdown (jika diperlukan)
        $categories = DB::table('product_categories')->pluck('category_name', 'id');

        return view('pages.editProduct', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
    
            $images = [];

            // Jika ada file gambar yang diunggah, proses upload
            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/image', $imageName);
                    $images[] = $imageName;
                }

                // Update nilai 'images' di basis data
                DB::table('products')->where('id', $id)->update(['images' => json_encode($images)]);
            }

            // Update data produk berdasarkan ID
            $product = Product::findOrFail($id);
            $product->update([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'category_id' => $request->category,
                'price' => $request->price,
                // 'image' => json_encode($images),
            ]);

            return redirect()->route('products')->with('success', 'Successfully Updated!');
        } catch (\Exception $e) {
            return redirect()->route('products.edit', $id)->with('error', 'Error Updating!: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('products')->where('id', $id)->delete();

            return redirect()->route('products')
                ->with('success', ' Successfully Deleted!');
        } catch (\Exception $e) {
            return redirect()->route('products')
                ->with('error', 'Error Deleting!: ' . $e->getMessage());
        }
    }
}
