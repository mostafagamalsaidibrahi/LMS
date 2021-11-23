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
<br><br><br><br><br><br><br><br><br>
<div class="addCourse">
  <div class="addCourseContainer text-center">

    <form action="/getting_materials_result" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <label for="cars">Choose a Course:</label>
      <select name="course">
        @foreach($studentCourses as $course)
        <option value="{{ $course->cname }}"> {{ $course->cname }} </option>
        @endforeach
      </select>

      <br><br>
      <button type="submit">Show</button>
    </form>

  </div>
</div>


@include('student.footer')
