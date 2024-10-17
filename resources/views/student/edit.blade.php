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
<form action="{{ route('student.update',$student->id) }}" method="POST" enctype="multipart/form-data">
@method('PUT')
    @csrf
     
    <div class="row">
     <div class="col-12 mb-2 mt-2">
            <div class="form-group">学年
                <input type="text" name="grade" class="form-control" placeholder="学年">
                @error('price')
                <span style="color:red;">学年を入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">名前
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="名前">
                @error('name')
                <span style="color:red;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="form-group">住所
                <input type="text" name="address" class="form-control" placeholder="住所">
                @error('name')
                <span style="color:red;">住所を入力してください</span>
                @enderror
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">コメント
            <textarea class="form-control" style="height:60px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
            <span style="color:red;">コメントを140文字で入力してください</span>
            @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">顔写真
            <div class="form-group">
            <input type="file" name="img_path" accept=".jpg,.png,image/gif,image/jpeg,image/png">
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
                <input type="hidden" name="page" value="{{ request()->input('page') }}">
                <button type="submit" class="btn btn-outline-primary w-100">変更</button>
        </div>
        <ul style="display: flex; list-style: none; padding: 40px;">
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ url('/students') }}">新規登録</a>
            </li>
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ url('/students') }}">　戻る　</a>
            </li>
        </ul>

        </div>
    
    </div>      
</form>
</div>
</div>
@endsection