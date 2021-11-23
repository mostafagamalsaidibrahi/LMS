<!-- @if(session('uId'))
<h1>{{session('uId')}}</h1>
@endif

@if(session('uImage'))
<img src="<?php echo asset('uploads/' . session('uImage') ) ?>">
@endif

@if(session('fullname'))
<h1>{{session('fullname')}}</h1>
@endif -->

<html>
    <head>
        <title>LMS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
          <link rel="stylesheet" href="<?php echo asset('css/admin/header.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/index.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/add_user.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/my_profile.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/courses.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/update.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/get_quiz.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/admin/statistics.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    </head>

    <body>

      <div class="navbar-section" id="myDIV">
        <br>
        <div class="logo text-center"><img src="<?php echo asset('images/logo.png'); ?>" alt=""></div>
        <br><br><br>
        <div class="links text-center">
          <a href="/admin_view"> <i class="fa fa-info-circle" aria-hidden="true"></i> Statistics </a>
          <a href="/courses"> <i class="fa fa-eye" aria-hidden="true"></i> Courses</a>
            <a href="/materials"> <i class="fa fa-eye" aria-hidden="true"></i> Materials </a>
            <a href="/quizes"> <i class="fa fa-eye" aria-hidden="true"></i> Quizes </a>
          <a href="/add_user"> <i class="fa fa-plus" aria-hidden="true"></i> Add User </a>
        </div>
      </div>
      <div class="head-section" id="head">

        <div class="container-fluid">
          <div class="row">
            <div class="info col-lg-4 col-md-4 col-sm-4">
              <button onclick="myFunction1()"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
              <button onclick="myFunction2()"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </div>
            <div class="myLinks col-lg-8 col-md-8 col-sm-8">
              <a href="/my_profile"> <i class="fa fa-cogs" aria-hidden="true"></i> </a>
              <a href="/logout"> <i class="fa fa-sign-out" aria-hidden="true"></i> </a>
            </div>
          </div>
        </div>
      </div>
      <div class="content" id="cont">


<script type="text/javascript">
  function myFunction1() {
  var x = document.getElementById("myDIV");
  var y = document.getElementById("head");
  var z = document.getElementById("cont");
    x.style.display = "none";
    y.style.marginLeft = "0px";
    z.style.marginLeft = "0px";
  }
  function myFunction2() {
  var x = document.getElementById("myDIV");
  var y = document.getElementById("head");
  var z = document.getElementById("cont");
    x.style.display = "block";
    y.style.marginLeft = "250px";
    z.style.marginLeft = "250px";
  }
</script>
