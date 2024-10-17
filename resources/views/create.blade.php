@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <div style="font-size:1.25rem;">商品新規登録画面</div>
        </div>
    </div>
</div>
 
<div style="text-align:left;">
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">商品名
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="名前">
                @error('name')
                <span style="color:red;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">メーカー名
                <select name="company_id" class="form-select">
                    <option>分類を選択してください</otion>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</otion>
                    @endforeach
                </select>
                @error('company')
                <span style="color:red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">価格
                <input type="text" name="price" class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">在庫数
                <input type="text" name="stock" class="form-control" placeholder="在庫数">
                @error('stock')
                <span style="color:red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">コメント
            <textarea class="form-control" style="height:60px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
            <span style="color:red;">{{ $message }}</span>
            @enderror
            </div>
        </div>
        商品画像
        <div class="col-12 mb-2 mt-2">
        <input type="file" name="img_path" accept=".jpg,.png,image/gif,image/jpeg,image/png">
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-outline-primary w-100">登録</button>
        </div>
        <ul style="display: flex; list-style: none; padding: 40px;">
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ url('/products') }}">新規登録</a>
            </li>
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ url('/products') }}">　戻る　</a>
            </li>
        </ul>

        </div>
    
    </div>      
</form>
</div>
</div>
@endsection