<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} の詳細</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>

<body>
    <div class="container">
        <a href="/products" class="back-link">商品一覧 ＞ {{ $product->name }}</a>

        <div class="product-detail">
            <div class="product-image">
                <img src="{{ asset('fruits-img/' . $product->image) }}" alt="{{ $product->name }}">
            </div>

            <form class="product-info"
                action="{{ url('/products/' . $product->id . '/update') }}"
                method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label for="name">商品名</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">

                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="price">値段</label>
                    <input id="price" type="number" name="price" min="0" step="1"
                        value="{{ old('price', $product->price) }}" class="form-control">

                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="image">商品画像</label>
                    <input id="image" type="file" name="image" accept="image/*" class="form-control">

                    <div class="form__error">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                @php
                $selected = old('seasons', $product->seasons->pluck('id')->all());
                $seasonLabels = [1=>'春', 2=>'夏', 3=>'秋', 4=>'冬'];
                @endphp

                <div class="form-group">
                    <label>季節</label>
                    <div class="seasons">
                        @foreach ($seasonLabels as $id => $label)
                        <label class="seasons-radio">
                            <input type="checkbox" name="seasons[]" value="{{ $id }}"
                                {{ in_array($id, $selected ?? [], true) ? 'checked' : '' }}>
                            <span class="dot" aria-hidden="true"></span>
                            <span>{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>

                    <div class="form__error">
                        @error('seasons')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">商品説明</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>

                    <div class="form__error">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ url('/products') }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-primary">変更を保存</button>
                </div>
            </form>

            <form action="{{ url('/products/' . $product->id . '/delete') }}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️</button>
            </form>
        </div>
    </div>
</body>

</html>