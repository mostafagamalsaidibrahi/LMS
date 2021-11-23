@include('student.header')

@yield('content')

@if(session('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>{{session('message')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<br><br>
<div class="quizes">
  <div class="requests-table">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">CName</th>
          <th scope="col">Quiz Name</th>
          <th scope="col">Time</th>
          <th scope="col">Fullmark</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      @foreach( $allowedQuizes as $obj )
      <tbody>
        <tr>
          <td>{{ $obj->course }}</td>
          <td>{{ $obj->quizName }}</td>
          <td>{{ $obj->TOQ }}</td>
          <td>{{ $obj->FM }}</td>
          <td>
            <a href="/request_quiz/{{ $obj->quizId }}" class="accept">Request</a>
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>
  </div>
</div>
<br><br>
<div class="showCourses">
  <button type="button" onclick="myFunction()"> Show </button>
  <br>
  <div class="courseData" id="myDIV2">
    <br>
    <div class="status-table">

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Quiz Name</th>
            <th scope="col">CName</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        @foreach ($statusRequest as $obj)
        <tbody>
          <tr>
            <td>{{ $obj->quizName }}</td>
            <td>{{ $obj->course }}</td>
            @if( $obj->status == 0 )
              <td class="wait">waiting</td>
            @elseif( $obj->status == 1 )
              @if( $obj->complete == 1)
                <td class="accept">
                  Accepted
                  <a href="/access/{{ $obj->qId }}"> Access </a>
                </td>
              @elseif( $obj->complete == 0)
                <td class="accept">Accepted <span>Wait Until Complete</span></td>
              @endif
            @else
              <td class="reject">Rejected</td>
            @endif
          </tr>
        </tbody>
        @endforeach
      </table>

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
</script>

@include('student.footer')
