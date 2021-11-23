<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{

    // getting statistics
    public function getStatistics (Request $request){

      $admins=  DB::table('users')->where(['type' => 'admin'])->count();
      $arr_admins = Array('admins'=>$admins);

      $doctors=  DB::table('users')->where(['type' => 'doctor'])->count();
      $arr_doctors = Array('doctors'=>$doctors);

      $students=  DB::table('users')->where(['type' => 'student'])->count();
      $arr_students = Array('students'=>$students);

      $quizes=  DB::table('requested_quiz')->count();
      $arr_quizes = Array('quizes'=>$quizes);

      $courses=  DB::table('courses')->count();
      $arr_courses = Array('courses'=>$courses);

      return view('admin.statistics')
          ->with(['admins'=>$admins])
          ->with(['doctors'=>$doctors])
          ->with(['students'=>$students])
          ->with(['quizes'=>$quizes])
          ->with(['courses'=>$courses]);
    }

    // adding new user
    public function addUser (Request $request){

      if($request->isMethod('post')){
        // validation
        $fullname = $request->input('fullname');
        $username = $request->input('username');
        $password = $request->input('password');
        $repassword = $request->input('repassword');
        $image = $request->input('image');
        $type = $request->input('type');

        if($fullname == "" || $username == "" || $password == "" || $repassword == ""|| $type == ""){
          return redirect('/add_user')->with('message' , 'Please complete your data');
        }else if( $password != $repassword ){
          return redirect('/add_user')->with('message' , 'Password is not match' );
        }else if( strlen($password) < 7 ){
          return redirect('/add_user')->with('message' , 'Password is very small');
        }else {
          // saving data
          $img_name = time() . '.' . $request->image->getClientOriginalExtension();
          $userObject = new User();
          $userObject->fullname = $fullname ;
          $userObject->username = $username ;
          $userObject->password = $password;
          $userObject->image = $img_name ;
          $userObject->type = $type;
          $userObject->save();
          $request->image->move(public_path('uploads') , $img_name);
          return redirect('/admin_view');
        }
      }

      return view('admin.add_user');
    }

    // My Profile function
    public function showMyProfile (Request $request){
      $uId = $request->session()->get('uId');
      $Data=  DB::table('users')->where(['uId' => $uId])->get();
      $arr = Array('Data'=>$Data);
      return view('admin.my_profile' , $arr);
    }

    // go to Update Profile Data
    public function goToUpdateProfile (Request $request , $userId){
      $Data=  DB::table('users')->where(['uId' => $userId])->get();
      $arr = Array('Data'=>$Data);
      return view('admin.update' , $arr);
    }

    // update function
    public function change(Request $request){
      if($request->isMethod('post')){
        // validation
        $fullname = $request->input('fullname');
        $username = $request->input('username');
        $password = $request->input('password');
        $repassword = $request->input('repassword');

        $uId = $request->session()->get('uId');

        if($fullname == "" || $username == "" || $password == "" || $repassword == ""){
          return redirect('/my_profile')->with('message' , 'Please complete your data');
        }else if( $password != $repassword ){
          return redirect('/my_profile')->with('message' , 'Password not match');
        }else if( strlen($password) < 7 ){
          return redirect('/my_profile')->with('message' , 'Password is less than 7 letters');
        }else {
          $affected = DB::table('users')
                ->where('uId', $uId)
                ->update(['fullname' => $fullname ,
                          'username' => $username ,
                          'password' => $password]);

          return redirect('/my_profile')->with('message' , 'Updated');
        }
    }
    return view('admin.my_profile');
  }

  // Getting Courses data
  public function getCourses (Request $request){

    // getting data to page
    $courses = DB::table('users')
                ->join('courses', 'users.uId', '=', 'courses.dId')
                ->where('courses.type' , '=' , 0)
                ->get();

    $arr = Array('courses'=>$courses);

    return view('admin.courses' , $arr);
  }

  // Accept Course
  public function acceptCourse (Request $request , $cId){

    DB::table('courses')->where('cId', $cId)->update(array('type' => 1));
    return redirect('/courses')->with('message' , 'Updated');
  }

  // Reject Course
  public function rejectCourse (Request $request , $cId){
    DB::table('courses')->where('cId', $cId)->update(array('type' => 2));
    return redirect('/courses')->with('message' , 'Updated');
  }

  // Getting Material data
  public function getMaterials (Request $request){

    // getting data to page
    $materials = DB::table('users')
                ->join('materials', 'users.uId', '=', 'materials.dId')
                ->where('materials.type' , '=' , 0)
                ->get();

    $arr = Array('materials'=>$materials);

    return view('admin.materials' , $arr);
  }

  // Accept Course
  public function acceptMaterials (Request $request , $mId){

    DB::table('materials')->where('mId', $mId)->update(array('type' => 1));
    return redirect('/materials')->with('message' , 'Updated');
  }

  // Reject Course
  public function rejectMaterials (Request $request , $mId){
    DB::table('materials')->where('mId', $mId)->update(array('type' => 2));
    return redirect('/materials')->with('message' , 'Updated');
  }

  // Getting Requested Quizes From Doctor
  public function getRequestedQuizes (Request $request){
    $quizData = DB::table('users')
            ->join('requested_quiz', 'users.uId', '=', 'requested_quiz.dId')
            ->where(['requested_quiz.status' => 0])
            ->get();
    $arr = Array('quizData'=>$quizData);
    return view ('admin.get_quizes' , $arr);
  }

  // accept Requested Quiz
  public function acceptQuiz (Request $request , $qId){

    DB::table('requested_quiz')->where('quizId', $qId)->update(array('status' => 1));
    return redirect('/quizes')->with('message' , 'Accepted');
  }

  // Reject Requested Quiz
  public function rejectQuiz (Request $request , $qId){
    DB::table('requested_quiz')->where('quizId', $qId)->update(array('status' => 2));
    return redirect('/quizes')->with('message' , 'Rejected');
  }

}
