<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('hello');
    }

    public function main() {
        return view('pages.dashboard');
    }

    public function product() {
        return view('pages.product');
    }
}
