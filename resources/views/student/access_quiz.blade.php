<html>
    <head>
        <title>LMS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
          <link rel="stylesheet" href="<?php echo asset('css/student/access_quiz.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    </head>

    <body>

      <div class="getting-quiz-question">
        <div class="quiz-title">

          <div class="card">
            @foreach( $mainInfo1 as $obj )
            <div class="card-header">Student Name</div>
            <ul class="list-group list-group-flush"><li class="list-group-item"> {{ $obj->username }} </li></ul>
            <div class="card-header">Student ID</div>
            <ul class="list-group list-group-flush"><li class="list-group-item"> {{ $obj->stdNum }} </li></ul>
            <div class="card-header">Department</div>
            <ul class="list-group list-group-flush"><li class="list-group-item"> {{ $obj->stdDept }} </li></ul>
            @endforeach
            @foreach( $mainInfo2 as $obj2 )
            <div class="card-header">Course Name</div>
            <ul class="list-group list-group-flush"><li class="list-group-item"> {{ $obj2->course }} </li></ul>
            <div class="card-header">Time</div>
            <ul class="list-group list-group-flush"><li class="list-group-item"> {{ $obj2->TOQ }} Min </li></ul>
            <div class="card-header">Fullmark</div>
            <ul class="list-group list-group-flush"><li class="list-group-item"> {{ $obj2->FM }} </li></ul>
          </div>

        </div>
        <div class="quiz-data">
          <br>
          <div class="questions">
            <div class="quiz-info text-center">
              <h1> {{ $obj2->quizName }} </h1>
            </div>
            <div class="details">
              <div class="stop-watch">
                <!-- create 3 stopwatches -->
                <div class="timer"><span id="time"> {{ $obj2->TOQ }}:00</span></div>
              </div>
              @endforeach
              <form action="/get_answers" method="post">
                {{csrf_field()}}
                <?php $counter = 1 ?>
              @foreach( $questionsData as $data )
                <div class="quiz">
                    <div class="ques">
                      {{$counter++}}) {{ $data->question }}
                    </div>
                    <br>
                    <div class="choice">
                      <div class="container">
                        <div class="row">
                          <div class="choice1 col-lg-6 col-md-6 col-sm-6">
                            <input type="radio" name="{{ $data->quesId }}" value="{{ $data->choice1 }}" class="inpt">
                            <label>{{ $data->choice1 }}</label><br>
                            <input type="radio" name="{{ $data->quesId }}" value="{{ $data->choice2 }}" class="inpt">
                            <label>{{ $data->choice2 }}</label>
                          </div>
                          <div class="choice1 col-lg-6 col-md-6 col-sm-6">
                            <input type="radio" name="{{ $data->quesId }}" value="{{ $data->choice3 }}" class="inpt">
                            <label>{{ $data->choice3 }}</label><br>
                            <input type="radio" name="{{ $data->quesId }}" value="{{ $data->choice4 }}" class="inpt">
                            <label>{{ $data->choice4 }}</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              @endforeach
              <br><br>
              <button type="submit">Submit</button>
            </form>
            </div>
          </div>
        </div>
      </div>


      <script>

function startTimer(duration, display, callback) {
  var timer = duration,
    minutes, seconds;

  var myInterval = setInterval(function() {
    minutes = parseInt(timer / 1, 10)
    seconds = parseInt(timer % 1, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes;

    if (--timer < 0) {
      timer = duration;

      // clear the interal
      clearInterval(myInterval);

      // use the callback
      if(callback) {
          callback();
      }
    }
  }, 1000);
}

window.onload = function() {
  var time = <?php foreach( $mainInfo2 as $obj4 ){ echo $obj4->TOQ  ; }  ?>,
    display = document.querySelector('#time');
  startTimer(time, display, function() {
    $('.inpt').attr('disabled', true);
    alert('Click On Submit Button');
   });
};
  </script>










      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="<?php echo asset('js/index.js');  ?>"></script>
    </body>
</html>
