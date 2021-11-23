@include('admin.header')

@yield('content')

<div class="title text-center">
  <h1>Courses</h1>
</div>
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
        <th scope="col">DocName</th>
        <th scope="col">CName</th>
        <th scope="col">Quiz Name</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    @foreach($quizData as $obj)
    <tbody>
      <tr>
        <td>{{ $obj->username }}</td>
        <td>{{ $obj->course }}</td>
        <td>{{ $obj->quizName }}</td>
        <td> <a href="/acceptQuiz/{{ $obj->quizId }}" class="accept"><i class="fa fa-check-square" aria-hidden="true"></i></a>
             <a href="/rejectQuiz/{{ $obj->quizId }}" class="reject"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>

@include('admin.footer')
