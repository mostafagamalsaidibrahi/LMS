<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // insert my Main Information
    public function addInfo (Request $request){
      if($request->isMethod('post')){

        // get data from view
        $stdId = $request->input('stdId');
        $stdDept = $request->input('dept');

        // check if exists
        $isExists = DB::table('std_info')
            ->where(['stdNum' => $stdId])->get();

        if( count($isExists) > 0 ){
          // exists
          return redirect('/user_view')->with('message' , 'This id is Exists');
        }else{
          // insert
          $uId = $request->session()->get('uId');

          DB::table('std_info')->insert(
              ['stdId' => $uId,
               'stdNum' => $stdId ,
               'stdDept' => $stdDept ]
          );

          // save dept in session
            $deptValue = $request->session()->put('deptInfo' , $stdDept);

          return redirect('/index');

        }
      }
      return view('student.main_info');
    }

    // Request Course based on My Selected  Field
    public function getCourses (Request $request){

      // get Id Of User
      $uId = $request->session()->get('uId');

      // get dept of users
      $deptData = $request->session()->get('deptInfo');

      if($deptData == 'is'){
        // getting user department
        $users = DB::table('users')
                    ->join('courses', function ($join) {
                          $join->on('users.uId', '=', 'courses.dId')
                               ->where(['courses.field' => 'is' , 'courses.type' => 1 ]);
                            })
                    ->get();

              if( count($users) > 0 ){
                  $arr = Array('users'=>$users);
                  return view('student.get_courses' , $arr);
                }
      }else if($deptData == 'cs'){
        $users = DB::table('users')
                    ->join('courses', function ($join) {
                          $join->on('users.uId', '=', 'courses.dId')
                               ->where(['courses.field' => 'cs' ]);
                            })
                    ->get();
                    if( count($users) > 0 ){
                        $arr = Array('users'=>$users);
                        return view('student.get_courses' , $arr);
                      }
      }else if($deptData == 'it'){
        $users = DB::table('users')
                    ->join('courses', function ($join) {
                          $join->on('users.uId', '=', 'courses.dId')
                               ->where(['courses.field' => 'it' ]);
                            })
                    ->get();
                    if( count($users) > 0 ){
                        $arr = Array('users'=>$users);
                        return view('student.get_courses' , $arr);
                      }
      }

    }

    // send Request for specific course
    public function sendRequest (Request $request , $cId){
      // get Id Of User
      $uId = $request->session()->get('uId');

      $isExist = DB::table('requested_course')
          ->where(['cId'=>$cId , 'stdId'=>$uId])->get();

          if( count($isExist) > 0){
            return redirect('/request_course')->with('message' , 'This Requested last');
          }else {


            DB::table('requested_course')->insert(
                ['stdId' => $uId , 'cId' => $cId , 'status' => 0]
            );
            return redirect('/request_course')->with('message' , 'Request Sent Please Wait until admin accept it');
          }
    }

    // send request for join Course
    public function sendRequestQuiz (Request $request){
      // get Id For Make Operation
      $uId = $request->session()->get('uId');

      // get Accepted Requested Courses
      $acceptedCourses = DB::table('requested_course')
                  ->join('courses', 'courses.cId', '=', 'requested_course.cId')
                  ->where([ 'requested_course.stdId' => $uId , 'requested_course.status' => '1' ])
                  ->get();

      $arr = Array('acceptedCourses'=>$acceptedCourses);

      if($request->isMethod('post')){
        // get Data from View
        $courseName = $request->input('course');
        // save selected course to session
        $selectedCourseToGetQuizes = $request->session()->put('courseToGetQuizes' , $courseName);

        return redirect('/get_quizes');
      }
      return view('student.join_quiz' , $arr);
    }

    // getting quizes of selected course
    public function getQuizes (Request $request){
      // getting Id of User
      $uId = $request->session()->get('uId');
      // Get Selected Course to get allowed quizes
      $course = $request->session()->get('courseToGetQuizes');


      // query for getting allowed quizes
      $allowedQuizes = DB::table('requested_quiz')
            ->join('quiz_data', 'quiz_data.qId', '=', 'requested_quiz.quizId')
            ->where(['requested_quiz.course' => $course , 'quiz_data.allow' => 1])
            ->get();

      $arr = Array('allowedQuizes'=>$allowedQuizes);

      $statusRequest = DB::table('std_request_quiz')
            ->join('requested_quiz', 'requested_quiz.quizId', '=', 'std_request_quiz.qId')
            ->join('quiz_data', 'quiz_data.qId', '=', 'requested_quiz.quizId')
            ->where(['std_request_quiz.stdId' => $uId , 'requested_quiz.course' => $course])
            ->select('requested_quiz.quizName' , 'requested_quiz.course' , 'std_request_quiz.status' , 'quiz_data.complete' , 'std_request_quiz.qId' )
            ->get();

      $arr2 = Array('statusRequest'=>$statusRequest);

      return view('student.getAllowedQuizes' , $arr , $arr2);
    }

    // actullay send request quiz
    public function RequestQuiz (Request $request , $qId){
      // getting Id of User
      $uId = $request->session()->get('uId');
      // check if exists
      $exists = DB::table('std_request_quiz')
                  ->where([ 'stdId' => $uId , 'qId' => $qId ])
                  ->get();

      if( count($exists) > 0 ){
        return redirect('/get_quizes')->with('message' , 'This Request is sent last');
      }else {
        // insert
        DB::table('std_request_quiz')->insert(
            ['stdId' => $uId , 'qId' => $qId]
        );
        return redirect('/get_quizes')->with('message' , 'Request is sent');
      }
    }

    // access quiz
    public function accessQuiz (Request $request , $qId){

      // get Id For Make Operation
      $uId = $request->session()->get('uId');
      // getting student grade
      $stdGrade = $request->session()->get('stdgrade');
      // getting quiz Id
      $quizIdValue = $request->session()->get('quizIdValue');

      // check if exists
      $checkIfExists = DB::table('finished_quiz')
            ->join('users', 'users.uId', '=', 'finished_quiz.uId')
            ->join('std_info', 'std_info.stdId', '=', 'finished_quiz.uId')
            ->where(['users.uId' => $uId , 'finished_quiz.qId' => $quizIdValue , 'finished_quiz.uId' => $uId , 'std_info.stdId' => $uId ])
            ->get();

      if ( count($checkIfExists) > 0 ) {
        // This Quiz is Finished
        $arr = Array('checkIfExists'=>$checkIfExists);
        return view('student.certificate' , $arr);
      }else{
        $mainInfo1 = DB::table('users')
              ->join('std_info', 'users.uId', '=', 'std_info.stdId')
              ->where(['std_info.stdId' => $uId])
              ->get();

        $arr = Array('mainInfo1'=>$mainInfo1);

        // Get Selected Course to get allowed quizes
        $course = $request->session()->get('courseToGetQuizes');

        $mainInfo2 = DB::table('requested_quiz')
              ->join('quiz_data', 'quiz_data.qId', '=', 'requested_quiz.quizId')
              ->where(['requested_quiz.course' => $course])
              ->get();

        $arr2 = Array('mainInfo2'=>$mainInfo2);

        // Getting questions
        $questionsData = DB::table('quiz_questions')
              ->where(['quiz_questions.quizId' => $qId])
              ->get();

        $quizIdValue = $request->session()->put('quizIdValue' , $qId);

        if( count($questionsData) > 0 ){
          $arrayData = Array('questionsData'=>$questionsData);
          return view('student.access_quiz' , $arr , $arr2)->with( ['questionsData' => $questionsData] );
        }else {
          return view('student.access_quiz' , $arr , $arr2);
        }
      }
    }

    // get Student answers
    public function getAnswers (Request $request){
      // getting quiz Id
      $quizIdValue = $request->session()->get('quizIdValue');
      // get Id For Make Operation
      $uId = $request->session()->get('uId');

      // query for access name of input
      $questionsData = DB::table('quiz_questions')
            ->where(['quiz_questions.quizId' => $quizIdValue])
            ->get();
            $stdAnswer = [];
        foreach ($questionsData as $obj)
            $stdAnswer[] = $request->input( $obj->quesId);

        foreach ($questionsData as $key)
            $answersFromDB[] = $key->answer ;

        $getQuizGrade = DB::table('quiz_questions')
            ->join('quiz_data', 'quiz_questions.quizId', '=', 'quiz_data.qId')
            ->select('quiz_data.FM')
            ->get();

        foreach ($getQuizGrade as $grade)
            // grade of one question in Quiz
            $questionGrade = $grade->FM / count($answersFromDB) ;
            $midExamGrade = $grade->FM / 2 ;

        // checking Did The Answers Of Student is attach to Correct Answers
        $finalGrade = 0 ;
        for( $i=0 ; $i < count($answersFromDB) ; $i++){
            if( $stdAnswer[$i] == $answersFromDB[$i] ){
              $finalGrade = $finalGrade + $questionGrade ;
            }else{
              $finalGrade = $finalGrade + 0 ;
            }
        }

        // Checking if student is Fail Or Pass
        if( $finalGrade >= $midExamGrade ){
          $status = $request->session()->put('stdstatus' , "Pass");
          $stdGrade = $request->session()->put('stdgrade' , $finalGrade);

          // insert the result
          DB::table('finished_quiz')->insert(
              ['uId' => $uId , 'qId' => $quizIdValue , 'stdGrade' => $finalGrade , 'midGrade' => $midExamGrade]
          );

          return redirect('/get_result');
        }else if( $finalGrade < $midExamGrade ){
          $status = $request->session()->put('stdstatus' , "Fail");
          $stdGrade = $request->session()->put('stdgrade' , $finalGrade);
          // insert the result
          DB::table('finished_quiz')->insert(
              ['uId' => $uId , 'qId' => $quizIdValue , 'stdGrade' => $finalGrade , 'midGrade' => $midExamGrade ]
          );
          return redirect('/get_result');
        }

    }

    // get Result View
    public function getResult (Request $request){

      // getting user id
      $uId = $request->session()->get('uId');
      // getting course
      $course = $request->session()->get('courseToGetQuizes');

      $studentData = DB::table('users')
            ->join('std_info', 'users.uId', '=', 'std_info.stdId')
            ->where(['users.uId' => $uId])
            ->select('users.username', 'std_info.stdNum', 'std_info.stdDept' , 'users.image')
            ->get();

      $arrStudentData = Array('studentData'=>$studentData);


      $doctorData = DB::table('users')
            ->join('courses', 'users.uId', '=', 'courses.dId')
            ->where(['courses.cname' => $course])
            ->select('users.username')
            ->get();

      $arrDoctorData = Array('doctorData'=>$doctorData);

      return view('student.student_result' , $arrStudentData , $arrDoctorData );
    }

    // send course name to show Materials
    public function getMaterials (Request $request){
      // getting user id
      $uId = $request->session()->get('uId');
      // query for get student courses from db
      $studentCourses = DB::table('requested_course')
            ->join('courses', 'courses.cId', '=', 'requested_course.cId')
            ->where(['requested_course.stdId' => $uId , 'requested_course.status' => 1])
            ->get();

      $arrStudentCourses = Array('studentCourses'=>$studentCourses);
      return view('student.show_materials' , $arrStudentCourses);
    }

    // get materials based on selected material name
    public function actullayGetMaterial (Request $request){
      // getting data from view
      $coursename = $request->input('course');
      // getting data from db based on selected course
      $gettingMaterials = DB::table('materials')
            ->where(['materials.course' => $coursename])
            ->get();

      $arrStudentMaterial = Array('gettingMaterials'=>$gettingMaterials);
      return view('student.getting_material' , $arrStudentMaterial);
    }














}
