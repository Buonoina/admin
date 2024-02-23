@extends('app')
  
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;"></h2>
            </div>
            <div class="text-right mb-1">
            <a class="btn btn-success" href="{{ route('product.create') }}">新規登録</a>
            </div>
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫</th>
            <th>メーカー名</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td style="width: 20%;">
            <img src="{{ Storage::url($product->img_path) }}" alt="" class="img-fluid"></td>
            <td style="text-align:right">{{ $product->name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->stock }}</td>
            <td>{{ $product->company->company_name}}</td>
            <td style="text-align:center">
            <a class="btn btn-primary" href="{{ route('product.create',$product->id) }}">変更</a>
            </td>
        </tr>
        @endforeach
    </table>
 
    {!! $products->links('pagination::bootstrap-5') !!}
@endsection
