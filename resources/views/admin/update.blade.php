@include('admin.header')

@yield('content')


<br>
<div class="add-user"><br><br>
  <div class="form-add text-center">
    <br><br>
    @foreach( $Data as $data)
    <form action="/change" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Fullname" name="fullname" value="{{$data->fullname}}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Username" name="username" value="{{$data->username}}">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" value="{{$data->password}}">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Re-Password" name="repassword">
      </div>
      <button type="submit" class="btn btn-primary form-control">Update</button>
    </form>
    @endforeach
  </div>
</div>
@include('admin.footer')
