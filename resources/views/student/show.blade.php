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
<form action="{{ route('student.update',$student->id) }}" method="POST" enctype="multipart/form-data">
@method('PUT')
    @csrf
     
    <dl class="row mt-3" >
        <dt class="col-sm-8">学年</dt>
        <dd class="col-sm-10">{{ $student->grade }}</dd>
        
        <dt class="col-sm-8">名前</dt>
        <dd class="col-sm-10">{{ $student->name }}</dd>
        
        <dt class="col-sm-8">住所</dt>
        <dd class="col-sm-10">{{ $student->address }}</dd>

        <dt class="col-sm-8">顔写真</dt>
        <dd class="col-sm-10"><img src="{{ Storage::url($student->img_path) }}" width="200"></dd>

        <dt class="col-sm-8">コメント</dt>
        <dd class="col-sm-10">{{ $student->comment }}</dd>

    </dl>

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <div style="font-size:1.25rem;">成績</div>
        </div>
    </div>
    <dl class="row mt-3" >
    <tr>
            <th>学年</th>
            <th>名前</th>
        </tr>
    </dl>
    <div class="text-right">
            <a class="btn btn-success" href="{{ route('school_grade.create') }}">成績登録</a>
            </div>

</div>
        <ul style="display: flex; list-style: none; padding: 40px;">
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ route('student.edit',$student->id) }}">編集　</a>
            </li>
            <li style="margin-right: 30px;">
                <a class="btn btn-outline-success" href="{{ url('/students') }}?page_id={{ $page_id }}">戻る　</a>
            </li>
        </ul>
    </div>
</form>
</div>
</div>
@endsection