@extends('app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報一覧</h1>

    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">商品新規登録</a>

   

    <div class="blogs mt-5">
        <h2>商品情報</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>メーカー</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>コメント</th>
                    <th>商品画像</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->product_name }}</td>
                    <td>{{ $blog->brand->company_name }}</td>
                    <td>{{ $blog->price }}</td>
                    <td>{{ $blog->stock }}</td>
                    <td>{{ $blog->comment }}</td>
                    <td><img src="{{ asset($blog->img_path) }}" alt="商品画像" width="100"></td>
                    </td>
                    <td>
                        <a href="{{ route('blogs.show', $blog) }}" class="btn btn-info btn-sm mx-1">詳細表示</a>
                        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary btn-sm mx-1">編集</a>
                        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    
</div>
@endsection