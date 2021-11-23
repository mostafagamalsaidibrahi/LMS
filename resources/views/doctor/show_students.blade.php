@include('doctor.header')

@yield('content')

@if(session('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>{{session('message')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<br><br><br><br><br><br><br>
<div class="students">
  <div class="requests-table">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Std Name</th>
          <th scope="col">CName</th>
          <th scope="col">Field</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      @foreach( $collection as $obj )
      <tbody>
        <tr>
          <td>{{ $obj->username }}</td>
          <td>{{ $obj->cname }}</td>
          <td>{{ $obj->field }}</td>
          <td> <a href="/accept_std_request/{{ $obj->reqId }}" class="accept"><i class="fa fa-check-square" aria-hidden="true"></i></a>
               <a href="/reject_std_request/{{ $obj->reqId }}" class="reject"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>
  </div>
</div>

@include('doctor.footer')
