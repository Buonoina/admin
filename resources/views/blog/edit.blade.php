<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    body {
        font-family: "Helvetica Neue",
            Arial,
            "Hiragino Kaku Gothic ProN",
            "Hiragino Sans",
            Meiryo,
            sans-serif;
    }
    </style>
    <title>商品一覧</title>
  </head>
  <body>
    <div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1 style="font-size:1.25rem;">商品新規登録画面</h2>
        </div>
    </div>
</div>
 
<div style="text-align:left;">
<form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">商品名
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="名前">
                @error('name')
                <span style="color:red;">商品名を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">メーカー名
                <select name="brand" class="form-select">
                    <option>分類を選択してください</otion>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->company_name }}</otion>
                    @endforeach
                </select>
                @error('brand')
                <span style="color:red;">メーカー名を選択してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">価格
                <input type="text" name="price" class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red;">価格を数値で入力してください</span>
                @enderror
            </div>
        </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">在庫数
                <input type="text" name="stock" class="form-control" placeholder="在庫数">
                @error('stock')
                <span style="color:red;">在庫を数値で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">コメント
            <textarea class="form-control" style="height:60px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
            <span style="color:red;">コメントを140文字で入力してください</span>
            @enderror
            </div>
        </div>
        商品画像
        <div class="col-12 mb-2 mt-2">
        <input type="file" name="img_path" accept=".jpg,.png,image/gif,image/jpeg,image/png">
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
    </div>      
</form>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>