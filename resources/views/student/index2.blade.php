@extends('app')

@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
        <h1 class="mt4">成績登録</h1>
          @if ($errors->any())
          <div class="alert alert-danger">
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
          </ul>
          </div>
           @endif
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form method="post" action="{{route('grade.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="grade">学年</label>
                    <input type="text" name="grade" class="form-control" id="grade" value="{{old('grade')}}" placeholder="grade">
                </div>

                <div class="form-group">
                    <label for="term">学期</label>
                    <input type="text" name="term" class="form-control" id="term" value="{{old('term')}}" placeholder="term">
                </div>

                <div class="form-group">
                    <label for="japanese">国語</label>
                    <input type="text" name="japanese" class="form-control" id="japanese" value="{{old('japanese')}}" placeholder="japanese">
                </div>

                <div class="form-group">
                    <label for="math">数学</label>
                    <input type="text" name="math" class="form-control" id="math" value="{{old('math')}}" placeholder="math">
                </div>

                <div class="form-group">
                    <label for="science">理科</label>
                    <input type="text" name="science" class="form-control" id="science" value="{{old('science')}}" placeholder="science">
                </div>

                <div class="form-group">
                    <label for="social_studies">社会</label>
                    <input type="text" name="social_studies" class="form-control" id="social_studies" value="{{old('social_studies')}}"  placeholder="social_studies">
                </div>
                
                <div class="form-group">
                    <label for="music">音楽</label>
                    <input type="text" name="music" class="form-control" id="music" value="{{old('music')}}" placeholder="music">
                </div>

                <div class="form-group">
                    <label for="home_economics">家庭科</label>
                    <input type="text" name="home_economics" class="form-control" id="home_economics" value="{{old('home_economics')}}"placeholder="home_economics">
                </div>

                <div class="form-group">
                    <label for="english">英語</label>
                    <input type="text" name="english" class="form-control" id="english" value="{{old('english')}}" placeholder="english">
                </div>

                <div class="form-group">
                    <label for="art">美術</label>
                    <input type="text" name="art" class="form-control" id="art" value="{{old('art')}}" placeholder="art">
                </div>

                <div class="form-group">
                    <label for="health_and_physical_education">保健体育</label>
                    <input type="text" name="health_and_physical_education" class="form-control" id="health_and_physical_education" value="{{old('health_and_physical_education')}}"placeholder="health_and_physical_education">
                </div>
                

                <x-button type="submit" class="btn btn-success">登録</x-button>
                <x-button type="button" onclick="history.back()">戻る</x-button>
            </form>
        </div>
    </div>
</div>

@endsection