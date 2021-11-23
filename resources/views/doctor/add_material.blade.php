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

    <form action="/add_material" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <label for="cars">Choose a Course:</label>
      <select name="course">
        @foreach($getCourse as $course)
        <option value="{{ $course->cname }}"> {{ $course->cname }} </option>
        @endforeach
      </select>

      <br><br>
      <div class="form-group">
        <input type="file" name="file" accept="application/pdf,application/vnd.ms-excel" >
      </div>
      <br>
      <button type="submit">Add</button>
    </form>

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
            <th scope="col">CName</th>
            <th scope="col">Resource</th>
            <th scope="col">Time</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        @foreach ($getMaterials as $obj)
        <tbody>
          <tr>
            <td>{{ $obj->course }}</td>
            <td>{{ $obj->resource }}</td>
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
