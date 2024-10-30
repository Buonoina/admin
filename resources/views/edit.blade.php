@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1.25rem;">編集画面</h2>
        </div>
    </div>
</div>

<div style="text-align:left;">
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-12 mb-2 mt-2">ID : {{ $product->id }}</div>
            <div class="row">
                <div class="col-12 mb-2 mt-2">商品名
                    <div class="form-group">
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="名前">
                        @error('name')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">メーカー名
                        <select name="company_id" class="form-select">
                            <option value="">{{ __('messages.select_company') }}</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @if($company->id == $product->company_id) selected @endif>{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">価格
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="価格">
                        @error('price')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">在庫数
                        <input type="text" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" placeholder="在庫数">
                        @error('stock')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">コメント
                        <textarea class="form-control" style="height:60px" name="comment" placeholder="コメント">{{ old('comment', $product->comment) }}</textarea>
                        @error('comment')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                商品画像
                <div class="col-12 mb-2 mt-2">
                    <input type="file" name="img_path" accept=".jpg,.png,image/gif,image/jpeg,image/png">
                    @if ($product->img_path)
                        <img src="{{ Storage::url($product->img_path) }}" alt="商品画像" style="max-width: 100px;">
                    @endif
                </div>

                <div class="col-12 mb-2 mt-2">
                    <input type="hidden" name="page" value="{{ request()->input('page') }}">
                    <button type="submit" class="btn btn-outline-primary w-100">変更</button>
                </div>

                <ul style="display: flex; list-style: none; padding: 40px;">
                    <li style="margin-right: 30px;">
                        <a class="btn btn-outline-success" href="{{ url('/products') }}">新規登録</a>
                    </li>
                    <li style="margin-right: 30px;">
                        <a class="btn btn-outline-success" href="{{ url('/products') }}">戻る</a>
                    </li>
                </ul>
            </div>
        </div>      
    </form>
</div>
@endsection
