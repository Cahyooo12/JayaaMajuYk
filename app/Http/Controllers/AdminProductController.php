<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    public function create()
    {
        return view('admin.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:products',
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->has('specs_raw')) {
            $specs = [];
            $lines = explode("\n", $request->specs_raw);
            foreach ($lines as $line) {
                if (str_contains($line, '=')) {
                    list($k, $v) = explode('=', $line, 2);
                    $specs[trim($k)] = trim($v);
                }
            }
            $data['specs'] = $specs;
        }

        if ($request->hasFile('image')) {
            $imageName = $request->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/products'), $imageName);
            $data['image'] = 'assets/products/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->has('specs_raw')) {
            $specs = [];
            $lines = explode("\n", $request->specs_raw);
            foreach ($lines as $line) {
                if (str_contains($line, '=')) {
                    list($k, $v) = explode('=', $line, 2);
                    $specs[trim($k)] = trim($v);
                }
            }
            $data['specs'] = $specs;
        } else {
            $data['specs'] = [];
        }

        if ($request->hasFile('image')) {
            $imageName = $product->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/products'), $imageName);
            $data['image'] = 'assets/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
