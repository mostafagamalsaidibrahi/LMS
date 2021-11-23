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
@foreach( $Data as $obj )


  <div class="user-data">
    <br><br><br>
    <div class="container">
      <div class="row">
        <div class="image col-lg-6 col-sm-6 col-md-6">
          @if(session('uImage'))
            <img class="card-img-top" alt="Card image cap"  src="<?php echo asset('uploads/' . session('uImage') ) ?>">
          @endif
        </div>
        <br>
        <div class="data col-lg-6 col-sm-6 col-md-6">
          <ul class="list-group">
            <li class="list-group-item active">Fullname</li>
            <li class="list-group-item not-active">{{ $obj->fullname }}</li>
            <li class="list-group-item active">Username</li>
            <li class="list-group-item not-active">{{ $obj->username }}</li>
            <li class="list-group-item active">Password</li>
            <li class="list-group-item not-active">{{ $obj->password }}</li>
            <li class="list-group-item active">Type</li>
            <li class="list-group-item not-active">{{ $obj->type }}</li>
          </ul>
          <br>
          <a href="/update/{{ $obj->uId }}">Update</a>
        </div>
      </div>
    </div>
  </div>
@endforeach


@include('admin.footer')
