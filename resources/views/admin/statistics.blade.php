@include('admin.header')

@yield('content')

@if(session('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>{{session('message')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif

  <div class="user-data">
    <br><br><br>
    <div class="container">
      <div class="row">
        <br>
        <div class="data">
          <ul class="list-group">
            <li class="list-group-item active">admins</li>
            <li class="list-group-item not-active"> {{$admins}} </li>
            <li class="list-group-item active">Doctors</li>
            <li class="list-group-item not-active">  {{$doctors}}  </li>
            <li class="list-group-item active">Students</li>
            <li class="list-group-item not-active">  {{$students}}  </li>
            <li class="list-group-item active">Courses</li>
            <li class="list-group-item not-active">  {{$courses}}  </li>
            <li class="list-group-item active">Quizes</li>
            <li class="list-group-item not-active">  {{$quizes}}  </li>
          </ul>
        </div>
      </div>
    </div>
  </div>


@include('admin.footer')
