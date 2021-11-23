<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Material;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // adding course
    public function addCourse (Request $request){

      // getting DId
      $uId = $request->session()->get('uId');

      if($request->isMethod('post')) {

        $field = $request->input('field');
        $courseName = $request->input('nameCourse');

        if($field == "" || $courseName == ""){
          return redirect('/add_course')->with('message' , 'Please complete your data');
        }else if(strlen($courseName) < 4){
          return redirect('/add_course')->with('message' , 'Please enter valid course name');
        }else{

          // insert data with wait message and value
          DB::table('courses')->insert(
              ['dId' => $uId ,
               'cname' => $courseName ,
               'field' => $field,
                'type' => 0]
          );
          return redirect('/add_course')->with('message' , 'added put wait until accepting it from admin');
        }

      }

      // getting data to page
      $getCourse = DB::table('courses')
          ->where(['dId'=>$uId])->get();

      $arr = Array('getCourse'=>$getCourse);

      return view('doctor.add_course' , $arr);
    }

    // adding Material
    public function addMaterial (Request $request){

      // getting data of doctor
      $uId = $request->session()->get('uId');

          $getCourse = DB::table('courses')
          ->where(['dId' => $uId])
          ->get();

      $arr = Array('getCourse'=>$getCourse);

      if($request->isMethod('post')){
        $course = $request->input('course');
        $material = $request->input('file');

        if($course == ""){
          return redirect('/add_material')->with('message' , 'Please complete your data');
        }else {
          // saving data
          $fileNameWithExt = $request->file('file')->getClientOriginalExtension();
          $filename = Pathinfo($fileNameWithExt , PATHINFO_FILENAME);
          $extension = $request->file('file')->getClientOriginalExtension();
          $filenameToStore = $filename . '_' . time() . '.' .$extension;
          $path = $request->file('file')->move(public_path('uploads') , $filenameToStore);
          $materialObject = new Material();
          $materialObject->dId = $uId ;
          $materialObject->course = $course ;
          $materialObject->resource = $filenameToStore;
          $materialObject->type = 0;
          $materialObject->save();

          return redirect('/add_material')->with('message' , 'added put wait until accepting it from admin');
        }
      }

      // getting data to page
      $getMaterials = DB::table('materials')
          ->where(['dId'=>$uId])->get();

      $arr2 = Array('getMaterials'=>$getMaterials);

      return view('doctor.add_material' , $arr , $arr2);
    }

    // selecting course to get students
    public function getRequestedStudents (Request $request){

        // getting data of doctor
        $uId = $request->session()->get('uId');

        $requestedStds = DB::table('courses')
                    ->where(['dId' => $uId , 'type'=>1])
                    ->get();

        $arr = Array('requestedStds'=>$requestedStds);

        return view ('doctor.get_requested_stds' , $arr);
    }

    // send selected course to get requested students
    public function sendToGetRequestedStudents (Request $request){
      // get selected course
      $courseValue = $request->input('courses');

      $selectedCourseValue = $request->session()->put('courses' , $courseValue );

      return redirect('/students');

    }

    // getting students who requested course
    public function getStudents(Request $request){

      // getting selected course
      $courseVal = $request->session()->get('courses');
                  $collection = DB::table('users')
                              ->join('requested_course' , 'requested_course.stdId' , '=' , 'users.uId')
                              ->join('courses', 'requested_course.cId', '=', 'courses.cId')
                              ->where([ 'courses.cname' => $courseVal , 'requested_course.status' => 0 ])
                              ->get();

                  $arr = Array('collection'=>$collection);

      return view('doctor.show_students' , $arr);
    }

    // accepting user request
    public function acceptUserCourseRequest (Request $request , $reqId){

      $affected = DB::table('requested_course')
                    ->where('reqId', $reqId)
                    ->update(['status' => 1]);

      return redirect ('/students');
    }

    // accepting user request
    public function rejectUserCourseRequest (Request $request , $reqId){

      DB::table('requested_course')->where('reqId', $reqId)->update(['status' => 2]);

      return redirect ('/students');
    }

    // get add quiz view
    public function makeQuiz (Request $request){

      // getting data of doctor
      $uId = $request->session()->get('uId');

      // getting submitted courses of this doctor
      $getCourses = DB::table('courses')
          ->where(['dId'=>$uId])->get();

      $arr = Array('getCourses'=>$getCourses);

      // getting status of requested quizes
      $getStatusOfCourses = DB::table('requested_quiz')
          ->where(['dId'=>$uId])->get();

      $arr2 = Array('getStatusOfCourses'=>$getStatusOfCourses);

      if($request->isMethod('post')){
        // get Quiz Name
        $quizName = $request->input('quiz_name');
        // get Selected Course
        $courseName = $request->input('course');

        if($quizName == ""){
          return redirect('/make_quiz')->with('message' , 'Please Complete Your Data');
        }else{
          // Check If Exists
          $exists = DB::table('requested_quiz')
              ->where(['dId'=>$uId , 'course' => $courseName , 'quizName' => $quizName])->get();
          if( count($exists) > 0 ){
            return redirect('/make_quiz')->with('message' , 'This Quiz name is Exist');
          }else{
            // insert Query
            DB::table('requested_quiz')->insert(
                ['dId' => $uId, 'quizName' => $quizName , 'course' => $courseName , 'status' => 0]
            );
            return redirect('/make_quiz')->with('message' , 'Data Inserted Please Wait until Admin Accept It');
          }
        }

      }

      return view('doctor.add_quiz' , $arr , $arr2 );
    }

    // getting view to setting Quiz Data
    public function setQuizData(Request $request , $qId){

      $Exists = DB::table('quiz_data')->where(['qId' => $qId ])->get();

      if( count($Exists) > 0 ){

        foreach ($Exists as $obj) {
          if( $obj->complete == 0){
            // insert question
            $arr = Array('Exists'=>$Exists);
            $quizIdValue = $request->session()->put('qId' , $qId);
            return redirect ('/quiz_settings');
          }else if( $obj->complete == 1){
            // Not Insert Questions
            // Count Questions of this quiz
            $quizQuestionCount =  DB::table('quiz_questions')->where(['quizId' => $qId])->count();

            return redirect('/make_quiz')->with('message' , 'This Quiz is completed by ' . $quizQuestionCount .' Question');
          }
        }
      }else {
        // send data to view on load
        $collection = DB::table('requested_quiz')->where(['quizId' => $qId])->get();
        $arr = Array('collection'=>$collection);

        // setting quiz Id In Session
        $quizIdValue = $request->session()->put('qId' , $qId);

        return view('doctor.quiz_data' , $arr);
      }
    }

    // setting quiz data
    public function actuallySetting (Request $request){
      if($request->isMethod('post')){
        $quizIdValue = $request->session()->get('qId');
        $timeOfQuiz = $request->input('timeOfQuiz');
        $fullMark = $request->input('fullMark');
        // validation
        if($timeOfQuiz == "" || $fullMark == ""){
          return redirect('/make_quiz')->with('message' , 'Please complete your data');
        }else if($timeOfQuiz < 120){
          return redirect('/make_quiz')->with('message' , 'Time should be start with value gratter than Or Equal 2 min');
        }else if($fullMark < 5){
          return redirect('/make_quiz')->with('message' , 'Mark should be start with value gratter than 4 min');
        }else{
          // insertion
          DB::table('quiz_data')->insert(
              ['qId' => $quizIdValue, 'TOQ' => $timeOfQuiz * 60 , 'FM' => $fullMark]
          );
          return redirect('/quiz_settings');
        }
      }
    }

    // Making Allow Quiz to Display to students
    public function AllowQuiz (Request $request , $qId){

      // check if quiz have question or not
      $ifContain = DB::table('quiz_questions')
                  ->where(['quizId' => $qId])
                  ->get();
      if( count($ifContain) > 0 ){

        // have questions

        $affected = DB::table('quiz_data')
                      ->where('qId', $qId)
                      ->update(['allow' => 1]);

        return redirect('/make_quiz')->with('message' , 'This Quiz is Allowed');
      }else{
        return redirect('/quiz_settings')->with('message' , 'Please insert question for your quiz');
      }
    }

    // make quiz settings
    public function quizSettings (Request $request){
      // get Data to View
      $quizIdValue = $request->session()->get('qId');
      // check if exists
      $Exists = DB::table('requested_quiz')->where(['quizId' => $quizIdValue])->get();
      $arr = Array('Exists'=>$Exists);

      // saving question
      if($request->isMethod('post')){
        // getting data from view
        $question = $request->input('question') ;
        $choice1 = $request->input('choice1') ;
        $choice2 = $request->input('choice2') ;
        $choice3 = $request->input('choice3') ;
        $choice4 = $request->input('choice4') ;
        $answer = $request->input('answer') ;

        // check Validation
        if($question == "" || $choice1== "" || $choice2 == "" || $choice3 == "" || $choice4 == "" ||$answer == ""){
          return redirect('/quiz_settings')->with('message' , 'Please complete your data');
        }else if( strlen($question) < 3){
          return redirect('/quiz_settings')->with('message' , 'Question Length should be gratter than 3 letters');
        }else if( $choice1 == $choice2 || $choice1 == $choice3 || $choice1 == $choice4 ||
                  $choice2 == $choice3 || $choice2 == $choice4 || $choice3 == $choice2){
          return redirect('/quiz_settings')->with('message' , 'There is some choises are match');
        }else{

          $answerValue = "";

          if($answer == "choice1"){
            $answerValue = $choice1;
          }else if($answer == "choice2"){
            $answerValue = $choice2;
          }else if($answer == "choice3"){
            $answerValue = $choice3;
          }else if($answer == "choice4"){
            $answerValue = $choice4;
          }
          // insertion query
          DB::table('quiz_questions')->insert(
              ['quizId' => $quizIdValue,
               'question' => $question,
               'choice1' => $choice1,
               'choice2' => $choice2,
               'choice3' => $choice3,
               'choice4' => $choice4,
               'answer' => $answerValue]
          );
          return redirect('/quiz_settings')->with('message' , 'Question is inserted');
        }

      }
      return view('doctor.quiz_settings' , $arr);
    }

    // Making Completness Of Question Of This Quiz
    public function completeQuestions (Request $request ){

      $quizIdValue = $request->session()->get('qId');

      $ifContain = DB::table('quiz_questions')
                  ->where(['quizId' => $quizIdValue])
                  ->get();

      if( count($ifContain) > 0 ){
        // Have Question Should be complete
        $affected = DB::table('quiz_data')
                      ->where('qId', $quizIdValue)
                      ->update(['complete' => 1]);

        return redirect('/make_quiz')->with('message' , 'Complete Action is Taken');
      }else{
        // Not Have Send Alert
        return redirect('/quiz_settings')->with('message' , 'Enter at least one question');
      }
    }

    // select course
    public function retriveRequestedQuiz (Request $request){
      // getting data of doctor
      $uId = $request->session()->get('uId');

      $requestedStdQuiz = DB::table('courses')
                  ->where(['dId' => $uId , 'type'=> 1])
                  ->get();
      $arr = Array('requestedStdQuiz'=>$requestedStdQuiz);
      return view('doctor.selection_course' , $arr);
    }

    // save selected course in session
    public function savingSelectedCourse (Request $request){
      $selectedCourse = $request->input('course');
      $courseSession = $request->session()->put('selectedCourse' , $selectedCourse);
      return redirect('/getting_students_quiz_request');
    }

    // Retrive requested quizes from students
    public function gettingStudentsQuizRequest (Request $request){
      // getting Id of User
      $uId = $request->session()->get('uId');
      // getting course name
      $courseName = $request->session()->get('selectedCourse');
      // query for getting data from DB
      $users = DB::table('users')
            ->join('std_request_quiz', 'std_request_quiz.stdId', '=', 'users.uId')
            ->join('requested_quiz', 'requested_quiz.quizId', '=', 'std_request_quiz.qId')
            ->where(['std_request_quiz.status' => 0 , 'requested_quiz.course' => $courseName ])
            ->get();

      $arr = Array('users'=>$users);
      return view('doctor.requested_quiz' , $arr);
    }

    // accept student quiz request
    public function acceptStdQuizRequest (Request $request , $sRQId){
      $affected = DB::table('std_request_quiz')
                    ->where('sRQId', $sRQId)
                    ->update(['status' => 1]);

      return redirect ('/getting_students_quiz_request');
    }
    // reject student quiz request
    public function rejectStdQuizRequest (Request $request , $sRQId){
      $affected = DB::table('std_request_quiz')
                    ->where('sRQId', $sRQId)
                    ->update(['status' => 2]);

      return redirect ('/getting_students_quiz_request');
    }
}
