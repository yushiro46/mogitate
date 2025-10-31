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
        // 対象の商品を取得（存在しなければ404エラー）
        $product = Product::findOrFail($productId);

        // 新しい画像がアップロードされた場合のみ処理
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = $image->getClientOriginalName(); // 元のファイル名を取得

            // 古い画像が存在していれば削除
            $oldPath = public_path('fruits-img/' . $product->image);
            if ($product->image && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // 新しい画像を public/fruits-img に保存
            $image->move(public_path('fruits-img'), $newName);

            // データベースに保存するファイル名を更新
            $product->image = $newName;
        }

        // 画像が未選択の場合はそのまま（何もしない）

        // 基本情報を更新
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        // 季節（seasons[]）を中間テーブルで同期
        $seasonIds = $request->input('seasons', []);
        $product->seasons()->sync($seasonIds);

        // 一覧ページにリダイレクト
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

            // ✅ 保存先を「public/fruits-img」に変更
            $destination = public_path('fruits-img');

            // フォルダが存在しなければ作成
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            // 画像を移動
            $image->move($destination, $imageName);
        }

        // 商品登録
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
