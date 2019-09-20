<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['admin']], function () {

Route::get('/', 'AttendenceController@firstStep');

// Auth::routes();

Route::get('/import', 'ImportController@getImport')->name('import');
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'ImportController@processImport')->name('import_process');

Route::resource('departments', 'DepartmentController');

Route::resource('sessions', 'SessionController');

Route::resource('semesters', 'SemesterController');



Route::resource('students', 'StudentController');

Route::get('/import/stuedent', 'StudentController@getImport')->name('import_student');
Route::post('/import/stuedent/parse', 'StudentController@parseImport')->name('import_parse_student');
Route::post('/import/stuedent/parse/process', 'StudentController@processImport')->name('import_process_student');

Route::post('find/students', 'StudentController@findStudent')->name('find_student');

Route::resource('courses', 'CourseController');

Route::resource('attendences', 'AttendenceController');
Route::get('/attendence/first', 'AttendenceController@firstStep')->name('attendence_first_step');
Route::post('/attendence/list', 'AttendenceController@index')->name('attendence_list');
Route::get('/attendence/add/{d_id}/{s_id}/{c_id}', 'AttendenceController@getStudent')->name('attendence_add');
Route::get('/ct/add/{d_id}/{s_id}/{c_id}/{ct}', 'AttendenceController@getCtStudent')->name('ct_add');
Route::post('/ct/add', 'AttendenceController@storeCt')->name('ct_store');
// Route::post('/attendence/stuedent', 'AttendenceController@getStudent')->name('attendence_student');

Route::get('/attendence/show/{d_id}/{s_id}/{c_id}', 'AttendenceController@showAll')->name('attendence_show_all');
Route::get('/attendence/download/{d_id}/{s_id}/{c_id}', 'AttendenceController@downloadAll')->name('attendence_download_all');

Route::resource('courseAssigns', 'CourseAssignController');

Route::resource('teachers', 'TeacherController');

});


Route::post('/register','RegisterLoginController@postRegister');
Route::post('/login','RegisterLoginController@postLogin');
Route::get('/activate/{email}/{activationCode}','RegisterLoginController@activateAccount');
Route::get('/forgot-password','RegisterLoginController@forgotPassword');
Route::post('/forgot-password','RegisterLoginController@postForgotPassword');
Route::get('/reset-password/{email}/{activationCode}','RegisterLoginController@resetPassword');
Route::post('/reset-password/{email}/{activationCode}','RegisterLoginController@postResetPassword');
Route::get('/login','RegisterLoginController@login');
Route::get('/register','RegisterLoginController@register');

Route::post('/logout','RegisterLoginController@logout');

