@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <div style="font-size:1.25rem;">詳細画面</div>
        </div>
    </div>
</div>
 
<div style="text-align:left;">
<form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
@method('PUT')
    @csrf
     
    <dl class="row mt-3" >

        <dt class="col-sm-8">ID</dt>
        <dd class="col-sm-10">{{ $product->id }}</dd>
    
        <dt class="col-sm-8">商品名</dt>
        <dd class="col-sm-10">{{ $product->name }}</dd>
        
        <dt class="col-sm-8">メーカー名</dt>
        <dd class="col-sm-10">{{ $product->company ? $product->company->company_name : '不明' }}
        </dd>

        <dt class="col-sm-8">価格</dt>
        <dd class="col-sm-10">{{ $product->price }}</dd>
    
        <dt class="col-sm-8">在庫</dt>
        <dd class="col-sm-10">{{ $product->stock }}</dd>
        
        <dt class="col-sm-8">コメント</dt>
        <dd class="col-sm-10">{{ $product->comment }}</dd>

        <dt class="col-sm-8">商品画像</dt>
        <dd class="col-sm-10"><img src="{{ Storage::url($product->img_path) }}" width="200"></dd>
    </dl>
</div>
        <ul style="display: flex; list-style: none; padding: 40px;">
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ route('product.edit',$product->id) }}">編集</a>
            </li>
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ url('/products') }}?page_id={{ $page_id }}">戻る</a>
            </li>
        </ul>
    </div>
</form>
</div>
</div>
@endsection