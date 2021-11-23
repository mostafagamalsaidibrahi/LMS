<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // login function
    public function Login (Request $request){

      if($request->isMethod('post')){
        $username = $request->input('username');
        $password = $request->input('password');

        // validation
        if($username == "" || $password == ""){
          return redirect('/')->with('message' , 'Please complete your data');
        }else if( strlen($password) < 7 ){
          return redirect('/')->with('message' , 'Insert Password Gratter Than 7 Letter');
        }else {
          $getAuth = DB::table('users')
              ->where(['username'=>$username ,'password'=>$password])->get();

          // $passwordValue = $request->session()->put('password' , $password);
          // $password = $request->session()->get('password');
          if( count($getAuth) > 0 ){
            // there is data found
            foreach ($getAuth as $data) {
              if ( $data->type == "student" ) {
                // user view
                $uIdValue = $request->session()->put('uId' , $data->uId);
                $imageValue = $request->session()->put('uImage' , $data->image);
                $fullnameValue = $request->session()->put('fullname' , $data->fullname);

                // Check If Saved His Info Or Not
                $uId = $request->session()->get('uId');

                $checkInfo = DB::table('std_info')
                    ->where(['stdId' => $uId])->get();

                if( count($checkInfo) > 0){

                  // get Dept
                  foreach($checkInfo as $data)
                    $dataDept = $request->session()->put('deptInfo' , $data->stdDept);
                  // Saved His Info
                  return redirect('/index');
                }else{
                  // Not Save His Info
                  return redirect('/user_view');
                }

              }else if ( $data->type == "admin" ) {
                // admin view
                $uIdValue = $request->session()->put('uId' , $data->uId);
                $imageValue = $request->session()->put('uImage' , $data->image);
                $fullnameValue = $request->session()->put('fullname' , $data->fullname);
                return redirect('/admin_view');
              }else if ( $data->type == "doctor" ) {
                // doctor view
                $uIdValue = $request->session()->put('uId' , $data->uId);
                $imageValue = $request->session()->put('uImage' , $data->image);
                $fullnameValue = $request->session()->put('fullname' , $data->fullname);
                return redirect('/doctor_view');
              }
            }
          }else {
            // username or password are wrong
            return redirect('/')->with('message' , 'Username Or Password are Wrong');
          }
        }
      }

      return view('main.index');
    }

    //logout
    public function logout (Request $request){
      $request->session()->forget('uId');
      return redirect('/');
    }
}
