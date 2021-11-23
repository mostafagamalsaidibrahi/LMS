<html>
    <head>
        <title>LMS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
          <link rel="stylesheet" href="<?php echo asset('css/student/main_info.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    </head>

    <body>

      @if(session('message'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{session('message')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      @endif

      <div class="main-info-form">
        <br><br><br><br><br><br><br><br>
        <div class="actualy-form text-center">
          <form action="/add_info" method="post">
            {{csrf_field()}}
            <div class="rows">
              <label for="exampleFormControlSelect1">Select Your ID</label>
              <select id="type" class="form-control" name="stdId">
                @for($i = 20150000 ; $i <= 20160000 ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
            <br>
            <div class="rows">
              <label for="exampleFormControlSelect1">Select Your Department</label>
              <select id="type" class="form-control" name="dept">
                <option value="cs">Computer Science</option>
                <option value="is">Information System</option>
                <option value="it">Information Technology</option>
              </select>
            </div>
            <br>
            <div class="rows">
              <button type="submit" class="form-control">Add</button>
            </div>
          </form>
        </div>
      </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="<?php echo asset('js/index.js');  ?>"></script>
  </body>

  </html>
