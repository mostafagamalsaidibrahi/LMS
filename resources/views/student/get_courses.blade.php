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
            <th scope="col">DocName</th>
            <th scope="col">Field</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        @foreach($users as $obj)
        <tbody>
          <tr>
            <td>{{ $obj->cname }}</td>
            <td>{{ $obj->fullname }}</td>
            <td>{{ $obj->field }}</td>
            <td> <a href="/sendRequest/{{ $obj->cId }}" class="accept"> Request </a>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
@include('student.footer')
