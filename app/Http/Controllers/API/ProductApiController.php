<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => $products,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Not found',
                'data' => null,
            ], 200);
        }
    }

    public function show($id)
    {
        try {
            $products = Product::find($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Data found',
                'data' => $products,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Not found',
                'data' => null,
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'description' => 'required',
            'is_active' => 'nullable',
            'price' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'stock' => 'required|numeric',
            'unit' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Data',
                'data' => $validate->errors(),
            ], 422);
        }

        try {
            $product = Product::create([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'category_id' => $request->category,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'price' => $request->price,
                'discount_amount' => $request->discount_amount,
                'stock' => $request->stock,
                'unit' => $request->unit,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data created successfully',
                'data' => $product,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create data: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_code' => 'required',
            'category' => 'required|exists:product_categories,id',
            'description' => 'required',
            'is_active' => 'nullable',
            'price' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'stock' => 'required|numeric',
            'unit' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Data',
                'data' => $validate->errors(),
            ], 422);
        }

        try {
            $product = Product::Where('id', $id)->update([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'category_id' => $request->category,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'price' => $request->price,
                'discount_amount' => $request->discount_amount,
                'stock' => $request->stock,
                'unit' => $request->unit,
            ]);
            // untuk menampilkan data yang di update kalo tampilan nya tidak mau angka 1 gunakan $product = Product::find($id);
            $product = Product::find($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Data updated successfully',
                'data' => $product,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update data: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Product::Where('id', $id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data deleted succesfully',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete data: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
