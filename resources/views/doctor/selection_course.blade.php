@include('doctor.header')

@yield('content')

<br><br><br><br><br><br><br><br><br>
<div class="selection text-center">
  <form action="/saving_selected_course" method="post">
    {{ csrf_field() }}
    <label for="cars">Choose a Course:</label>
    <select name="course">
      @foreach($requestedStdQuiz as $course)
      <option value="{{ $course->cname }}"> {{ $course->cname }} </option>
      @endforeach
    </select>
    <br><br>
    <button type="submit">Add</button>
  </form>
</div>

@include('doctor.footer')
