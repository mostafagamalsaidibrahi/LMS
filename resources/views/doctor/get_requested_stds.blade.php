@include('doctor.header')

@yield('content')
<br><br><br><br><br><br><br><br><br>
<div class="get-requested-stds">
  <div class="content-section text-center">

    <form action="/send_to_get_requested_students" method="post">
        {{ csrf_field() }}
      <label for="cars">Choose a Course:</label>

      <select name="courses">
        @foreach( $requestedStds as $obj )
          <option value="{{ $obj->cname }}">{{ $obj->cname }}</option>
        @endforeach
      </select>
      <button type="submit">Get</button>
    </form>
  </div>
</div>

@include('doctor.footer')
