@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1 style="font-size:1.25rem;">詳細画面</h2>
        </div>
    </div>
</div>
 
<div style="text-align:left;">
<form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
@method('PUT')
    @csrf
     
    <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $product->name }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $product->user_name }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            @foreach ($companies as $company)
                @if ($company->id == $product->company_id)
                    {{ $company->company_name }}
                @endif
            @endforeach
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $product->price }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $product->stock }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            {{ $product->comment }}                
            </div>
        </div>
        <div style="width: 20%;">
            <img src="{{ Storage::url($product->img_path) }}" alt="" class="img-fluid" width="85" >
        </div>
        <ul style="display: flex; list-style: none; padding: 40px;">
            <li style="margin-right: 30px;">
                <a class="btn btn-success" href="{{ route('product.edit',$product->id) }}">　編集　</a>
            </li>
            <li style="margin-right: 30px;">
                <a class="btn btn-success" href="{{ url('/products') }}?page_id={{ $page_id }}">　戻る　</a>
            </li>
        </ul>
    </div>
</form>
</div>
</div>
@endsection