<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        
        $products = [];

        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                'id' => $i,
                'name' => "Product $i",
                'description' => "Deskripsi produk ke-$i",
                'price' => rand(10000, 200000),
            ];
        }

        return view('products.list', compact('products'));
    }

    public function create()
    {
        return view('products.form');
    }

    public function edit($id)
    {
        
        return view('products.edit', compact('id'));
    }

    public function show($id)
    {
        return view('products.show', compact('id'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        
        return redirect()->route('products')->with('success', 'Product stored (dummy).');
    }

    public function update(Request $request, $id)
    {
       
        return redirect()->route('products')->with('success', "Product updated: $id (dummy).");
    }
}
