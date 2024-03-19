
@extends('app')
  
@section('content')
 
<div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;"></h2>
            </div>
            <div class="text-right mb-1">
            <a class="btn btn-success" href="{{ route('blog.create') }}">新規登録</a>
            </div>
        </div>
    </div>
    <div class="w-75">
        {!! $blogs->links('pagination::bootstrap-5') !!}
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    
    <table class="table table-bordered w-75">
        @foreach ($blogs as $blog)
        <tr>
            <td style="width: 7%;" class="fst-italic">{{ $blog->id }}</td>
            <td style="width: 20%;">
            <img src="{{ Storage::url($blog->img_path) }}" alt="商品画像" class="img-fluid">
            </td>
            <td>
                <h2 class="fs-5 text-primary">{{ $blog->name}}</h2>                
                {!! nl2br($blog->content) !!}
                <div class="text-end">
                @if(Auth::id()==$blog->user_id)
                    <!--<a class="btn btn-sm btn-info" href="{{ route('blog.edit',$blog->id) }} }}">
                        変更</a>-->
                    <a class="btn btn-sm btn-success" 
                    href="{{ route('blog.edit',[$blog->id, 'page' => request()->input('page')]) }}">
                        変更</a>
                @endif
                @if(Auth::id()==$blog->user_id)
                <form action="{{ route('blog.destroy',[$blog->id, 'page' => request()->input('page')]) }}" 
                method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" 
                    onclick='return confirm("削除しますか？");'>削除</button>
                </form>
                @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    
    @endsection