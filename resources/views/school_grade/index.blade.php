@extends('student.app') 

@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">学生表示画面</h2>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="#">新規登録</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>学年</th>
            <th>学期</th>
            <th>国語</th>
            <th>数学</th>
            <th>理科</th>
            <th>社会</th>
            <th>音楽</th>
            <th>家庭科</th>
            <th>英語</th>
            <th>美術</th>
            <th>保健体育</th>
        </tr>
        @foreach ($school_grades as $school_grade)
        <tr>
            <td style="text-align:right">{{ $school_grade->grade->grade_id->grade }}</td>
            <td style="text-align:right">{{ $school_grade-grade->>grade_id->term }}</td>
            <td style="text-align:right">{{ $school_grade->japanese }}</td>
            <td style="text-align:right">{{ $school_grade->math }}</td>
            <td style="text-align:right">{{ $school_grade->science }}</td>
            <td style="text-align:right">{{ $school_grade->social_studies }}</td>
            <td style="text-align:right">{{ $school_grade->music }}</td>
            <td style="text-align:right">{{ $school_grade->home_economics }}</td>
            <td style="text-align:right">{{ $school_grade->english }}</td>
            <td style="text-align:right">{{ $school_grade->art }}</td>
            <td style="text-align:right">{{ $school_grade->health_and_physical_education }}</td>
            
        </td>
</tr>
   @endforeach 
  </table> 
 
    {!! $school_grades->links('pagination::bootstrap-5') !!}
    
  @endsection