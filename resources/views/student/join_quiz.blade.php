@include('student.header')

@yield('content')

<br><br><br><br><br><br><br><br><br>
<div class="request-quiz text-center">
  <form action="/sendRequestQuiz" method="post">
    {{ csrf_field() }}
    <label for="cars">Choose a Course:</label>
    <select name="course">
      @foreach($acceptedCourses as $course)
      <option value="{{ $course->cname }}"> {{ $course->cname }} </option>
      @endforeach
    </select>

    <button type="submit">Show</button>
  </form>
</div>

@include('student.footer')
