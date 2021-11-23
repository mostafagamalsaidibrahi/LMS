<?php

// Main Folder Routes
Route::get('/', "UserController@Login");
Route::post('/', "UserController@Login");

// Logout
Route::get('/logout', "UserController@logout");
Route::post('/logout', "UserController@logout");

////////////////////////////////////// Student Folder Routes /////////////////////////////
Route::get('/user_view' , function(){ return view('student.main_info'); });

// Student Folder Routes
Route::get('/index' , function(){ return view('student.index'); });

// Add Info Route
Route::get('/add_info' , "StudentController@addInfo");
Route::post('/add_info' , "StudentController@addInfo");

// Get courses to make Request
Route::get('/request_course' , "StudentController@getCourses");
Route::post('/request_course' , "StudentController@getCourses");

// send request Course
Route::get('/sendRequest/{id}' , "StudentController@sendRequest");
Route::post('/sendRequest/{id}' , "StudentController@sendRequest");

// send request quiz
Route::get('/sendRequestQuiz' , "StudentController@sendRequestQuiz");
Route::post('/sendRequestQuiz' , "StudentController@sendRequestQuiz");

// getting requested quizes
Route::get('/get_quizes' , "StudentController@getQuizes");
Route::post('/get_quizes' , "StudentController@getQuizes");

// actually sending request of quiz
Route::get('/request_quiz/{id}' , "StudentController@RequestQuiz");
Route::post('/request_quiz/{id}' , "StudentController@RequestQuiz");

// access complete and allowed quiz
Route::get('/access/{id}' , "StudentController@accessQuiz");
Route::post('/access/{id}' , "StudentController@accessQuiz");

// get student answers
Route::get('/get_answers' , "StudentController@getAnswers");
Route::post('/get_answers' , "StudentController@getAnswers");

// get Result Of Quiz
Route::get('/get_result' , "StudentController@getResult");
Route::post('/get_result' , "StudentController@getResult");

// send course name to get material
Route::get('/get_materials' , "StudentController@getMaterials");
Route::post('/get_materials' , "StudentController@getMaterials");

// get materials
Route::get('/getting_materials_result' , "StudentController@actullayGetMaterial");
Route::post('/getting_materials_result' , "StudentController@actullayGetMaterial");

// My Profile View
Route::get('/my_profile' , "AdminController@showMyProfile");

// go to update my data
Route::get('/update/{id}' , "AdminController@goToUpdateProfile");

// update function
Route::get('/change' , "AdminController@change");
Route::post('/change' , "AdminController@change");

//////////////////////////////////////// Doctor Folder Routes /////////////////////////////////////
Route::get('/doctor_view' , function(){ return view('doctor.index'); });

// Add Course Route
Route::get('/add_course' , "DoctorController@addCourse");
Route::post('/add_course' , "DoctorController@addCourse");


// Adding Material
Route::get('/add_material' , "DoctorController@addMaterial");
Route::post('/add_material' , "DoctorController@addMaterial");

// select course to get requested students
Route::get('/requested_students' , "DoctorController@getRequestedStudents");
Route::post('/requested_students' , "DoctorController@getRequestedStudents");

// send data to get students
Route::get('/send_to_get_requested_students' , "DoctorController@sendToGetRequestedStudents");
Route::post('/send_to_get_requested_students' , "DoctorController@sendToGetRequestedStudents");

// get Students Who Request Courses
Route::get('/students' , "DoctorController@getStudents");
Route::post('/students' , "DoctorController@getStudents");

// accept student course request
Route::get('/accept_std_request/{id}' , "DoctorController@acceptUserCourseRequest");
Route::post('/accept_std_request/{id}' , "DoctorController@acceptUserCourseRequest");

// reject student course request
Route::get('/reject_std_request/{id}' , "DoctorController@rejectUserCourseRequest");
Route::post('/reject_std_request/{id}' , "DoctorController@rejectUserCourseRequest");

// making quiz
Route::get('/make_quiz' , "DoctorController@makeQuiz" );
Route::post('/make_quiz' , "DoctorController@makeQuiz" );

// get view to set quiz details
Route::get('/set_quiz_data/{id}' , "DoctorController@setQuizData");
Route::post('/set_quiz_data/{id}' , "DoctorController@setQuizData");

// set Data Of Quiz
Route::get('/setData' , "DoctorController@actuallySetting");
Route::post('/setData' , "DoctorController@actuallySetting");

// Allow Quiz for students
Route::get('/allow_quiz/{id}' , "DoctorController@AllowQuiz");
Route::post('/allow_quiz/{id}' , "DoctorController@AllowQuiz");

// set Questions Of Quiz
Route::get('/quiz_settings' , "DoctorController@quizSettings");
Route::post('/quiz_settings' , "DoctorController@quizSettings");

// Making complete questions of quiz
Route::get('/complete_questions' , "DoctorController@completeQuestions");
Route::post('/complete_questions' , "DoctorController@completeQuestions");

// Retrive Requested quiz from student
Route::get('/selection' , "DoctorController@retriveRequestedQuiz");
Route::post('/selection' , "DoctorController@retriveRequestedQuiz");

// saving selected course in session
Route::get('/saving_selected_course' , "DoctorController@savingSelectedCourse");
Route::post('/saving_selected_course' , "DoctorController@savingSelectedCourse");

// getting quiz Requested
Route::get('/getting_students_quiz_request' , "DoctorController@gettingStudentsQuizRequest");
Route::post('/getting_students_quiz_request' , "DoctorController@gettingStudentsQuizRequest");

// reject student quiz request
Route::get('/accept_std_quiz_request/{id}' , "DoctorController@acceptStdQuizRequest");
Route::post('/accept_std_quiz_request/{id}' , "DoctorController@acceptStdQuizRequest");

// reject student quiz request
Route::get('/reject_std_quiz_request/{id}' , "DoctorController@rejectStdQuizRequest");
Route::post('/reject_std_quiz_request/{id}' , "DoctorController@rejectStdQuizRequest");
////////////////////////////////////// Admin Folder Routes ///////////////////////////////////////

// Statistics View
Route::get('/admin_view' , "AdminController@getStatistics");
Route::post('/admin_view' , "AdminController@getStatistics");

// courses view
Route::get('/courses' , "AdminController@getCourses");
// accept course
Route::get('/acceptCourse/{id}' , "AdminController@acceptCourse");
Route::post('/acceptCourse/{id}' , "AdminController@acceptCourse");
// reject course
Route::get('/rejectCourse/{id}' , "AdminController@rejectCourse");
Route::post('/rejectCourse/{id}' , "AdminController@rejectCourse");

// materials  view
Route::get('/materials' , "AdminController@getMaterials");
// accept materials
Route::get('/acceptMaterials/{id}' , "AdminController@acceptMaterials");
Route::post('/acceptMaterials/{id}' , "AdminController@acceptMaterials");
// reject materials
Route::get('/rejectMaterials/{id}' , "AdminController@rejectMaterials");
Route::post('/rejectMaterials/{id}' , "AdminController@rejectMaterials");

// add User View
Route::get('/add_user' , "AdminController@addUser");
Route::post('/add_user' , "AdminController@addUser");

// My Profile View
Route::get('/my_profile' , "AdminController@showMyProfile");

// go to update my data
Route::get('/update/{id}' , "AdminController@goToUpdateProfile");

// update function
Route::get('/change' , "AdminController@change");
Route::post('/change' , "AdminController@change");

// get requested quizes from doctor action
Route::get('/quizes' , "AdminController@getRequestedQuizes");
Route::post('/quizes' , "AdminController@getRequestedQuizes");

// accept quiz
Route::get('/acceptQuiz/{id}' , "AdminController@acceptQuiz");
Route::post('/acceptQuiz/{id}' , "AdminController@acceptQuiz");
// reject quiz
Route::get('/rejectQuiz/{id}' , "AdminController@rejectQuiz");
Route::post('/rejectQuiz/{id}' , "AdminController@rejectQuiz");
