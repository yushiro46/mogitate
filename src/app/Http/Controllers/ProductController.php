<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Product::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('id', 'asc');
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('index', compact('products'));
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        return view('show', compact('product'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = $image->getClientOriginalName();
            $image->move(public_path('fruits-img'), $newName);
            $date['image'] = $newName;
        }

        $product->update($data);

        $seasonIds = $request->input('seasons', []);
        $product->seasons()->sync($seasonIds);

        return redirect('/products');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect('/products');
    }

    public function create()
    {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            $destination = public_path('fruits-img');
            $image->move($destination, $imageName);
        }

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $imageName,
            'description' => $request->input('description'),
        ]);

        if ($request->filled('seasons')) {
            $product->seasons()->sync($request->input('seasons'));
        }
        return redirect('/products');
    }
}
