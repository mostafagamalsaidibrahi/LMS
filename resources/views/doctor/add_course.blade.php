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

<div class="addCourse">
  <div class="addCourseContainer text-center">

    <form action="/add_course" method="post">
      {{ csrf_field() }}
      <label for="cars">Choose a Field:</label>
      <select name="field" id="field">
        <option value="cs">Computer Science </option>
        <option value="is">Information System</option>
        <option value="it">Internet Technology</option>
      </select>

      <br><br>
      <div class="form-group">
        <input type="text" placeholder="Enter Course Name" name="nameCourse">
      </div>
      <br>
      <button type="submit">Add</button>
    </form>

  </div>
</div>
<br>
<div class="showCourses">
  <button type="button" onclick="myFunction()"> Requested Courses Status</button>
  <br>
  <div class="courseData" id="myDIV2">
    <br>
    <div class="status-table">

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">CName</th>
            <th scope="col">Field</th>
            <th scope="col">Time</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        @foreach ($getCourse as $obj)
        <tbody>
          <tr>
            <td>{{ $obj->cname }}</td>
            <td>{{ $obj->field }}</td>
            <td>{{ $obj->time }}</td>
            @if( $obj->type == 0 )
              <td class="wait">waiting</td>
            @elseif( $obj->type == 1 )
              <td class="accept">Accepted</td>
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
</script>

@include('doctor.footer')
