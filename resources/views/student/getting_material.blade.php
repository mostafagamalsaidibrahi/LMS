@include('student.header')

@yield('content')
<br><br><br><br>
<div class="getCourses">
  <div class="info">

    <div class="title text-center">
      <h1>Request Courses</h1>
    </div>
    <br>
    @if(session('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{session('message')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif
    <div class="requests-table">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">CName</th>
            <th scope="col">Resource</th>
            <th scope="col">Time</th>
          </tr>
        </thead>
        @foreach($gettingMaterials as $obj)
        <tbody>
          <tr>
            <td>{{ $obj->course }}</td>
            <td><a href="{{ url('/uploads/'.$obj->resource) }}" class="pdf_open" target="_blank">{{ $obj->resource }}</a></td>
            <td>{{ $obj->time }}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
@include('student.footer')
