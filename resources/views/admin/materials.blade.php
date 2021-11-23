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
        <th scope="col">Resource</th>
        <th scope="col">Time</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    @foreach($materials as $obj)
    <tbody>
      <tr>
        <td>{{ $obj->fullname }}</td>
        <td>{{ $obj->course }}</td>
        <td> <a href="{{ url('/uploads/'.$obj->resource) }}" target="_blank">{{ $obj->resource }}</a> </td>
        <td>{{ $obj->time }}</td>
        <td> <a href="/acceptMaterials/{{ $obj->mId }}" class="accept"><i class="fa fa-check-square" aria-hidden="true"></i></a>
             <a href="/rejectMaterials/{{ $obj->mId }}" class="reject"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>

@include('admin.footer')
