@extends('app') 

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="text-right mb-1">
      <div style="font-size:1.25rem;">商品一覧画面</div> <a class="btn btn-outline-success" href="{{ route('product.create') }}">新規登録</a> </div>
  </div>
</div>
<!-- 検索フォーム。GETメソッドで、商品一覧のルートにデータを送信 -->
<form action="{{ route('products.index') }}" method="GET" class="row g-3">
  <!-- 商品名検索用の入力欄 -->
  <div class="col-sm-12 col-md-3"> <input type="text" name="search" class="form-control" placeholder="商品名" value="{{ request('search') }}"> </div>
  <!-- メーカー名 (DB から取得) -->
  <div class="col-sm-12 col-md-3"> <select size="1" name="company" class="form-control">
			<option value="">未選択</option>
				@foreach ($companies as $company)
				<option value="{{$company -> id}}">{{$company -> company_name}}</option>
				@endforeach
			</select> </div>
  <div class="col-sm-12 col-md-2"> <button class="btn btn-secondary" type="submit">検索</button> </div>
</form>
<!-- 検索条件をリセットするためのリンクボタン --><a href="{{ route('products.index') }}" class="btn btn-outline-success">検索条件を元に戻す</a>
<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>商品画像</th>
    <th>商品名</th>
    <th>価格</th>
    <th>在庫</th>
    <th>メーカー名</th>
  </tr> @foreach ($products as $product)
  <tr>
    <td style="text-align:right">{{ $product->id }}</td>
    <td style="width: 20%;"> <img src="{{ Storage::url($product->img_path) }}" alt="" class="img-fluid" width="85"></td>
    <td style="text-align:right">{{ $product->name }}</td>
    <td style="text-align:right">{{ $product->price }}円</td>
    <td style="text-align:right">{{ $product->stock }}</td>
    <td style="text-align:right">{{ $product->company->company_name}}</td>
    <td style="text-align:center"> @auth <a class="btn btn-outline-primary" href="{{ route('product.show',$product->id) }}">詳細</a> @endauth </td>
    <td style="text-align:center">
      <form action="{{ route('product.destroy',$product->id) }}" method="POST"> 
        @csrf @method('DELETE') 
        <button type="submit" class="btn btn-outline-danger" onclick='return confirm("削除しますか？");'>削除
      </button>
    </form>
  </td>
</tr>
   @endforeach 
  </table> 
  {!! $products->links('pagination::bootstrap-5') !!} 
  @endsection