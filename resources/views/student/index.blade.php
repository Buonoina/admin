@extends('app') 

@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">学生表示画面</h2>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="{{ route('student.create') }}">新規登録</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>学年</th>
            <th>名前</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td style="text-align:right">{{ $student->grade }}</td>
            <td>{{ $student->name }}</td>
            <td style="text-align:center"> 
            @auth 
            <a class="btn btn-outline-primary" href="{{ route('student.show',$student->id) }}">詳細</a> 
            @endauth
        </td>
            <td style="text-align:center">
            <form action="{{ route('student.destroy',$student->id) }}" method="POST"> 
                @csrf 
                @method('DELETE') 
                <button type="submit" class="btn btn-outline-danger" onclick='return confirm("削除しますか？");'>削除
            </button>
        </form>
    </td>
</tr>
        @endforeach
    </table>
 
    {!! $students->links('pagination::bootstrap-5') !!}
    
  @endsection