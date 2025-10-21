<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>商品登録</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
    <header class="site-header">
        <div class="logo">mogitate</div>
    </header>

    <main class="wrap">
        <h1 class="page-title">商品登録</h1>

        <form class="form" action="/products" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 商品名 -->
            <div class="form-row">
                <label class="label" form="name">商品名 <span class="req">必須</span></label>
                <input id="name" name="name" type="text" class="input" placeholder="商品名を入力" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- 値段 -->
            <div class="form-row">
                <label class="label" for="price">値段 <span class="req">必須</span></label>
                <input id="price" name="price" type="number" class="input" placeholder="値段を入力" />
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- 画像 -->
            <div class="form-row">
                <span class="label">商品画像 <span class="req">必須</span></span>
                <label class="file-btn">ファイルを選択
                    <input type="file" name="image" accept="image/*" hidden />
                </label>
                <small class="hint">＊ JPEG/PNG などの画像ファイル</small>
                <div class="form__error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- 季節 (複数選択) -->
            <div class="form-row">
                <span class="label">
                    季節 <span class="req">必須</span>
                    <span class="note">複数選択可</span>
                </span>
                <div class="season-group">
                    <label class="radio"><input type="checkbox" name="seasons[]" value="1" />春</label>
                    <label class="radio"><input type="checkbox" name="seasons[]" value="2" />夏</label>
                    <label class="radio"><input type="checkbox" name="seasons[]" value="3" />秋</label>
                    <label class="radio"><input type="checkbox" name="seasons[]" value="4" />冬</label>
                </div>
                <div class="form__error">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- 説明 -->
            <div class="form-row">
                <label class="label" for="description">商品説明 <span class="req">必須</span></label>
                <textarea id="description" name="description" class="textarea" rows="8" placeholder="商品の説明を入力"></textarea>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <!-- ボタン -->
            <div class="actions">
                <a href="/products" class="btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </form>
    </main>
</body>

</html>