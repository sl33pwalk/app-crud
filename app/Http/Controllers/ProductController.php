<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $newProduct = Product::create($data);

        return redirect(route('product.index'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('product.index'))->with('success', 'Product deleted successfully! <a class="bg-black text-white py-2 px-4 rounded hover:bg-emerald-700 transition duration-300" href="' . route('product.restore', ['product' => $product]) . '">Undo</a>');
    }

    public function restore(int $product) {
        $product = Product::withTrashed()->find($product);
        $product->restore();

        return redirect(route('product.index'))->with('success', 'Product restored successfully');
    }
}
