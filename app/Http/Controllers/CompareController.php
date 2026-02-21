<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class CompareController extends Controller
{
    public function index()
    {
        $compareIds = session()->get('compare', []);
        $compareProducts = Product::whereIn('id', $compareIds)->get();

        $allSpecKeys = [];
        foreach ($compareProducts as $p) {
            if ($p->specs) {
                $allSpecKeys = array_merge($allSpecKeys, array_keys($p->specs));
            }
        }
        $allSpecKeys = array_unique($allSpecKeys);

        return view('compare', compact('compareProducts', 'allSpecKeys'));
    }

    public function add(Request $request)
    {
        $compare = session()->get('compare', []);
        
        if (!in_array($request->id, $compare)) {
            if (count($compare) < 4) {
                $compare[] = $request->id;
                session()->put('compare', $compare);
                return redirect()->back()->with('success', 'Produk ditambahkan ke perbandingan.');
            } else {
                return redirect()->back()->with('error', 'Maksimal 4 produk dalam perbandingan.');
            }
        }

        return redirect()->back()->with('info', 'Produk sudah ada dalam perbandingan.');
    }

    public function remove(Request $request)
    {
        $compare = session()->get('compare', []);
        $compare = array_diff($compare, [$request->id]);
        session()->put('compare', $compare);
        
        return redirect()->back()->with('success', 'Produk dihapus dari perbandingan.');
    }

    public function clear()
    {
        session()->forget('compare');
        return redirect()->back()->with('success', 'Perbandingan dikosongkan.');
    }
}
