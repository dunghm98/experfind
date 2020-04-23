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
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('homepage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search','TutorController@index')->name('list-tutor');

Route::get('/tutor-profile/{tutor}', 'TutorController@viewTutorProfile')->name('tutor-profile');

Route::get('/speciality/{speciality}', 'TutorController@searchBySpeciality')->name('search-tutor-by-speciality');

Route::get('/tutor/register', function (){
    return view('auth.tutor-register');
})->name('tutor-register');


Route::get('/request-tutor', function (){
    return view('request-tutor');
});



Route::get('/tutor/dashboard', 'TutorController@mainDashboard')->name('tutor.dashboard');
Route::post('/tutor/dashboard/accept', 'TutorController@acceptRequest')->name('tutor.acceptRequest');
Route::post('/tutor/dashboard/decline', 'TutorController@declineRequest')->name('tutor.declineRequest');
Route::post('/tutor/dashboard/delete', 'TutorController@deleteRequest')->name('tutor.deleteRequest');
Route::get('/tutor/dashboard/appointment', 'TutorController@listAppointment')->name('tutor.listAppointment');
Route::get('/student/dashboard', 'StudentController@mainDashboard')->name('student.dashboard');
Route::post('/student/dashboard/accept', 'StudentController@acceptRequest')->name('student.acceptRequest');
Route::post('/student/dashboard/decline', 'StudentController@declineRequest')->name('student.declineRequest');
Route::post('/student/dashboard/delete', 'StudentController@deleteRequest')->name('student.deleteRequest');

Route::get('/tutor/appointment', function (){
    return view('tutor.appointment');
});

Route::get('/tutor/transaction', function (){
    return view('tutor.transaction');
});

Route::get('/tutor/social', function (){
    return view('tutor.social');
});

Route::get('/tutor/schedule', function (){
    return view('tutor.schedule');
});

Route::get('/tutor/review', function (){
    return view('tutor.review');
});

Route::get('/tutor/dashboard/profile', 'TutorController@showProfile')->name('tutor.showProfile');
Route::patch('/tutor/dashboard/update-profile/{tutor}', 'TutorController@updateProfile')->name('tutor.updateProfile');

Route::get('/tutor/student', function (){
    return view('tutor.student');
});
Route::get('/tutor/message', function (){
    return view('tutor.message');
});

Route::get('/tutor/change-password', function (){
    return view('tutor.change-password');
});

Route::post('tutors/update-auth-info', 'TutorController@updateAuthInfo')
    ->name('tutors.updateAuthInfo');

Route::get('tutors/{auth}/delete-auth-info', 'TutorController@deleteAuthInfo')
    ->name('tutors.deleteAuthInfo');
Route::post('tutors/{tutor}/create-auth-info', 'TutorController@createAuthInfo')
    ->name('tutors.createAuthInfo');





Route::post('subjects/get/by/specialities', 'SubjectController@getBySpeciality')
    ->name('subjects.getBySpeciality');

Route::get('subjects/get-list', 'SubjectController@getList')
    ->name('subjects.getList');



Route::get('/student/change-password', function (){
    return view('student.change-password');
});

Route::get('/student/message', function (){
    return view('student.message');
});

Route::get('/student/profile/', 'StudentController@getProfile')
    ->name('students.getProfile');
Route::post('/get-student-list-request/', 'StudentController@getListRequest')
    ->name('students.getListRequest');

Route::get('/student/profile/{student}', 'StudentController@viewProfile')
    ->name('students.viewProfile');

Route::patch('/student/profile/{user}', 'StudentController@update')->name('student.update');

Route::get('/request-for-tutor/', 'RequestController@create')
    ->name('request.create')->middleware('auth');

Route::patch('/request-for-tutor/', 'RequestController@store')->name('request.store');

Route::get('/list-request-for-tutor/', 'RequestController@listRequest')->name('request.list');

Route::get('/detail-request-for-tutor/{request}', 'RequestController@showRequest')->name('request.detail');

Route::post('/ask-for-teach', 'TutorController@askForTeach')->name('tutor.askForTeach');

Route::post('/book-tutor', 'StudentController@bookTutor')->name('student.bookTutor');

Route::resource('students', 'StudentController');


Route::get('/student/favorite-tutor', function (){
    return view('student.favorite-tutor');
});


Route::get('/get-district-list/{city}', 'DistrictController@getDistrictList')
    ->name('districts.getByCity');


/** SPECIALITY CONTROLLER */
Route::get('specialities/get-all', 'SpecialityController@getAll')
    ->name('specialities.getAll');
Route::get('specialities/get-list', 'SpecialityController@getList')
    ->name('specialities.getList');




/** Search Controller */

Route::post('/suggest-search', 'SeachController@searchFullText')->name('search');
Route::get('/search/tutor/location/{location}/subject/{subject}','SeachController@searchTutor')->name('search.tutor');
