@include('student.header')

@yield('content')

<br>
<div class="result">
  <div class="head">
    <h3>Your Result</h3>
  </div>
  <br><br>
  <div class="stdData">
    <div class="container-fluid">
      <div class="row">
        @foreach( $checkIfExists as $stdData )
        <div class="image col-lg-3 col-md-3 col-sm-3">
          <img class="card-img-top" alt="Card image cap"  src="<?php echo asset('uploads/' . $stdData->image ) ?>">
        </div>
        <div class="data col-lg-9 col-md-9 col-sm-9">
            <p>
              <span class="title">Student Name :</span>
              <span class="ans">{{ $stdData->username }} </span>
            </p>
            <p>
              <span class="title">Student ID :</span>
              <span class="ans">{{ $stdData->stdNum }}</span>
            </p>
            <p>
              <span class="title">Student Dept :</span>
              <span class="ans">{{ $stdData->stdDept }}</span>
            </p>
            <p>
              <span class="title">Course Name :</span>
              @if(session('courseToGetQuizes'))
              <span class="ans">{{ session('courseToGetQuizes') }}</span>
              @endif
            </p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="finalResult">

    @if ( $stdData->stdGrade < $stdData->midGrade )
      <p class="query">You Are Fail</p>
    @elseif ( $stdData->stdGrade >= $stdData->midGrade )
      <p class="query">You Are Pass</p>
    @endif

    <p class="gradeinfo">Your Grade : {{$stdData->stdGrade}}</p>

  </div>
  <br>
</div>
@include('student.footer')
