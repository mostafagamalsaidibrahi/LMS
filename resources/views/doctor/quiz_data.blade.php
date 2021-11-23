@include('doctor.header')

@yield('content')
@if(session('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>{{session('message')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif


<br><br><br><br><br><br>
<div class="set-quiz-data">
  <br>
  @foreach($collection as $obj)
  <h1 style="text-align:center">{{ $obj->quizName }} Data</h1>
  @endforeach
  <br><br>

  <div class="form-add text-center">
    <form action="/setData" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <input type="number" class="form-control" placeholder="Enter Quiz Time By Seconds" name="timeOfQuiz">
      </div>
      <div class="form-group">
        <input type="number" class="form-control" placeholder="Enter Full Mark Value" name="fullMark">
      </div>
      <button type="submit" class="btn btn-primary form-control">Save</button>
    </form>
  </div>
</div>

@include('doctor.footer')
