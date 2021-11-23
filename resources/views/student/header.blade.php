<html>
    <head>
        <title>LMS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
          <link rel="stylesheet" href="<?php echo asset('css/student/header.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/index.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/get_courses.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/join_quiz.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/allowed_quizes.css') ?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/student_result.css')?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/show_materials.css')?>">
          <link rel="stylesheet" href="<?php echo asset('css/student/getting_material.css')?>">
        <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    </head>

    <body>

      <div class="navbar-section" id="myDIV">
        <br><br><br>
        <div class="logo text-center"><img src="<?php echo asset('images/logo.png'); ?>" alt=""></div>
        <br><br>
        <div class="links text-center">
          <a href="/index"> <i class="fa fa-eye" aria-hidden="true"></i> Home </a>
          <a href="/request_course"> <i class="fa fa-plus-square" aria-hidden="true"></i> Request Course</a>
          <a href="/get_materials"> <i class="fa fa-plus-square" aria-hidden="true"></i> Show Materials</a>
          <a href="/sendRequestQuiz"> <i class="fa fa-eye" aria-hidden="true"></i> Join Quiz </a>

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
      <div class="content"  id="cont">
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
