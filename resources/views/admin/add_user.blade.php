@include('admin.header')

@yield('content')
<br><br>
@if(session('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>{{session('message')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<br>
<div class="add-user"><br><br>
  <div class="form-add text-center">
    <form action="/add_user" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Fullname" name="fullname">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Username" name="username">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Re-Password" name="repassword">
      </div>
      <div class="form-group">
        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" >
      </div>
      <div class="form-group">
        <select id="type" class="form-control" name="type">
          <option value="admin">Admin</option>
          <option value="student">Student</option>
          <option value="doctor">Doctor</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary form-control">Add User</button>
    </form>
  </div>
</div>

@include('admin.footer')
