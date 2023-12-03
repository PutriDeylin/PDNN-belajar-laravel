<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('hello');
    }

    public function main() {
        $jumlahProduk = Product::count();
        $jumlahKategori = Category::count();
        $jumlahTotalHarga = Product::sum('price');
        $jumlahStok = Product::sum('stock');
         
          $produk_kategori = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
          ->selectRaw('product_categories.category_name, COUNT(products.category_id) as total_produk')
          ->groupBy('product_categories.category_name')
          ->pluck('total_produk', 'category_name');
          $chartData = [];
  
          foreach ($produk_kategori as $kategori => $total_produk) {
              $chartData[] = ['name' => $kategori, 'y' => $total_produk];
          }
  
          $harga_produk = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
          ->selectRaw('product_categories.category_name, SUM(products.price) as total_harga_produk')
          ->groupBy('product_categories.category_name')
          ->pluck('total_harga_produk', 'category_name');
  
          $chartHarga = [];
  
          foreach ($harga_produk as $kategori => $total_harga_produk) {
              $total_harga_produk = floatval($total_harga_produk);
  
              $chartHarga[] = ['name' => $kategori, 'y' => $total_harga_produk];
          }
          $produk_stock = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
          ->selectRaw('product_categories.category_name, SUM(products.stock) as jumlah_produk')
          ->groupBy('product_categories.category_name')
          ->pluck('jumlah_produk', 'category_name');
          $chartStock = [];
  
          foreach ($produk_stock as $kategori => $jumlah_produk) {
              $chartStock[] = ['name' => $kategori, 'y' => floatval($jumlah_produk)];
          }
        return view('pages.dashboard', compact('jumlahProduk', 'jumlahKategori', 'jumlahTotalHarga', 'jumlahStok',
          ))->with([
            'chartData' => json_encode($chartData),
            'chartHarga' => json_encode($chartHarga),
            'chartStock' => json_encode($chartStock),
        ]);
    }

    public function product() {
        return view('pages.product');
    }
}
