<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
    <header class="header">
        <h1 class="logo">mogitate</h1>
    </header>

    <main class="main">
        <aside class="sidebar">
            <h2>商品一覧</h2>

            {{-- 商品名検索 --}}
            <form action="products/search" method="get" class="search-form">
                <input type="text" name="keyword" placeholder="商品名で検索"
                    class="search-box" value="{{ request('keyword') }}">
                <button type="submit" class="search-btn">検索</button>

                {{-- 並び替え (価格順) --}}
                <h3>価格順で表示</h3>
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="">価格で並べ替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
                </select>
            </form>

            {{-- タグ表示 (検索条件と並び替え条件) --}}
            <div class="active-tags">
                @if(request('keyword'))
                <span class="tag">検索: "{{ request('keyword') }}"
                    <a href="/products" class="remove">×</a>
                </span>
                @endif

                @if(request('sort') == 'asc')
                <span class="tag">
                    価格: 安い順
                    <a href="/products" class="remove">×</a>
                </span>
                @elseif(request('sort') == 'desc')
                <span class="tag">
                    価格: 高い順
                    <a href="/products" class="remove">×</a>
                </span>
                @endif
            </div>
        </aside>

        <section class="products">
            <a href="products/register" class="add-btn">＋ 商品の追加</a>
            <div class="product-grid">
                @foreach ($products as $product)
                <a href="{{ url('products/' . $product->id) }}" class="product-card">
                    <img src="{{ asset('fruits-img/' .$product->image) }}" alt="{{ $product->name }}">
                    <p class="name">{{ $product->name }}</p>
                    <p class="price">¥{{ number_format($product->price) }}</p>
                </a>
                @endforeach
            </div>

            <div class="pagination">
                {{ $products->links('pagination::default') }}
            </div>
        </section>
    </main>
</body>

</html>