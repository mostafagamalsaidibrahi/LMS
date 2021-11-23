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
<br>
<div class="quiz-details text-center">
  <form action="/make_quiz" method="post">
    {{csrf_field()}}
    <label for="cars">Choose a Course:</label>
    <select name="course">
      @foreach($getCourses as $course)
      <option value="{{ $course->cname }}"> {{ $course->cname }} </option>
      @endforeach
    </select><br><br><br>
    <input type="text" placeholder="Enter Quiz Name" name="quiz_name" id="qName">
    <button type="submit" name="button">Send</button>
  </form>
</div>
<div class="showCourses">
  <button type="button" onclick="myFunction()"> Requested Quizes Status</button>
  <br>
  <div class="courseData" id="myDIV2">
    <br>
    <div class="status-table">

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Quiz Name</th>
            <th scope="col">cName</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        @foreach ($getStatusOfCourses as $obj)
        <tbody>
          <tr>
            <td>{{ $obj->quizName }}</td>
            <td>{{ $obj->course }}</td>
            @if( $obj->status == 0 )
              <td class="wait">waiting</td>
            @elseif( $obj->status == 1 )
              <td class="accept">Accepted
                <span>
                      <a href="/set_quiz_data/{{ $obj->quizId }}" style="text-decoration: none; font-size:20px; color:#115373; margin-left:20px;">
                          <i class="fa fa-arrow-right"></i>
                      </a>
                </span>
                <a href="/allow_quiz/{{ $obj->quizId }}" style="text-decoration: none; font-size:20px; color:green; margin-left:20px;">
                    Allow
                </a>
               </td>
            @else
              <td class="reject">Rejected</td>
            @endif
          </tr>
        </tbody>
        @endforeach
      </table>

  </div>
</div>
</div>
<script type="text/javascript">
window.onload = function() {
  document.getElementById('myDIV2').style.display = 'none';
};
function myFunction() {
  var x = document.getElementById("myDIV2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
$("input#qName").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
</script>

@include('doctor.footer')
