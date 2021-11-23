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
<br><br><br><br><br><br><br><br><br>
<div class="quiz_settings">
  <div class="title">
    @foreach ($Exists as $obj)
     <h1>{{ $obj->quizName }} Settings Of {{ $obj->course }} Course  </h1>
    @endforeach
  </div>
  <div class="action text-center">
    <button type="button" data-toggle="modal" data-target="#exampleModal">Add Question</button>
    <a href="/complete_questions" style="text-decoration:none;">Done</a>
  </div>
</div>
<!-- Question Setter Section  -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $obj->quizName }} Questions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/quiz_settings" method="post">
          {{ csrf_field() }}
          <label for="fname">Question 1:</label>
          <textarea class="form-control" name="question" rows="2"></textarea>
          <label for="lname">choice 1:</label>
          <input type="text" name="choice1"><br>
          <label for="fname">choice 2:</label>
          <input type="text" name="choice2"><br>
          <label for="fname">choice 3:</label>
          <input type="text" name="choice3"><br>
          <label for="fname">choice 4:</label>
          <input type="text" name="choice4"><br>
          <label>Select Answer</label>
          <select name="answer">
            <option value="choice1">Choice 1</option>
            <option value="choice2">Choice 2</option>
            <option value="choice3">Choice 3</option>
            <option value="choice4">Choice 4</option>
          </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add">Save Question</button>
      </div>
      </form>
    </div>
  </div>
</div>


@include('doctor.footer')
