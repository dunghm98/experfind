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


Route::get('/tutor/transaction', function (){
    return view('tutor.transaction');
});

Route::get('/tutor/social', function (){
    return view('tutor.social');
});

Route::get('/tutor/dashboard/schedule', 'TutorController@showTutorSchedule')->name('tutor.showSchedule');;
Route::patch('/tutor/dashboard/schedule-update/', 'TutorController@updateSchedule')->name('tutor.updateSchedule');

Route::get('/tutor/review', function (){
    return view('tutor.review');
});

Route::get('/tutor/dashboard/profile', 'TutorController@showProfile')->name('tutor.showProfile');
Route::patch('/tutor/dashboard/update-profile/{tutor}', 'TutorController@updateProfile')->name('tutor.updateProfile');

Route::get('/tutor/student', function (){
    return view('tutor.student');
});
Route::get('/tutor/student', 'TutorController@listStudent')->name('tutor.listStudent');

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
Route::post('/filter-request-for-tutor/', 'RequestController@filterRequest')->name('request.filter');
Route::get('/list-request-for-tutor-by-tag/', 'RequestController@listRequestByTag')->name('request.tagSearch');

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

Route::get('/suggest-search', 'SearchController@searchFullText')->name('search');
Route::get('/search/tutor/location/{location}/subject/{subject}','SeachController@searchTutor')->name('search.tutor');
Route::get('/filter-search', 'SearchController@filterByLocation')->name('home.search');
Route::post('/tutor-filter-search', 'SearchController@tutorFilter')->name('tutor.searchFilter');



//Admin
Route::get('/admin/dashboard', 'AdminController@showDashBoard')->name('showDashBoard');

Route::get('/admin/cities', 'AdminController@showCities')->name('showCities');
Route::get('/admin/city/{city}', 'AdminController@editCity')->name('editCity');
Route::post('/admin/city/save', 'AdminController@saveCity')->name('saveCity');
Route::get('/admin/add-city', 'AdminController@createCity')->name('createCity');
Route::post('/admin/city', 'AdminController@storeCity')->name('storeCity');
Route::get('/admin/city/delete/{city}', 'AdminController@deleteCity')->name('deleteCity');

Route::get('/admin/districts', 'AdminController@showDistricts')->name('showDistricts');
Route::get('/admin/district/{district}', 'AdminController@editDistrict')->name('editDistrict');
Route::post('/admin/district/save', 'AdminController@saveDistrict')->name('saveDistrict');
Route::get('/admin/add-district', 'AdminController@createDistrict')->name('createDistrict');
Route::post('/admin/district', 'AdminController@storeDistrict')->name('storeDistrict');
Route::get('/admin/district/delete/{district}', 'AdminController@deleteDistrict')->name('deleteDistrict');


Route::get('/admin/specialities', 'AdminController@showSpecialities')->name('showSpecialities');
Route::get('/admin/speciality/{speciality}', 'AdminController@editSpeciality')->name('editSpeciality');
Route::post('/admin/speciality/save', 'AdminController@saveSpeciality')->name('saveSpeciality');
Route::get('/admin/add-speciality', 'AdminController@createSpeciality')->name('createSpeciality');
Route::post('/admin/speciality', 'AdminController@storeSpeciality')->name('storeSpeciality');
Route::get('/admin/speciality/delete/{speciality}', 'AdminController@deleteSpeciality')->name('deleteSpeciality');


Route::get('/admin/subjects', 'AdminController@showSubjects')->name('showSubjects');
Route::get('/admin/subject/{subject}', 'AdminController@editSubject')->name('editSubject');
Route::post('/admin/subject/save', 'AdminController@saveSubject')->name('saveSubject');
Route::get('/admin/add-subject', 'AdminController@createSubject')->name('createSubject');
Route::post('/admin/subject', 'AdminController@storeSubject')->name('storeSubject');
Route::get('/admin/subject/delete/{subject}', 'AdminController@deleteSubject')->name('deleteSubject');


Route::get('/admin/tutors', 'AdminController@showTutors')->name('showTutors');
Route::get('/admin/tutor/{tutor}', 'AdminController@viewTutor')->name('viewTutor');
Route::get('/admin/tutor/delete/{tutor}', 'AdminController@deleteTutor')->name('deleteTutor');


Route::get('/admin/students', 'AdminController@showStudents')->name('showStudents');
Route::get('/admin/student/{student}', 'AdminController@viewStudent')->name('viewStudent');
Route::get('/admin/student/delete/{student}', 'AdminController@deleteStudent')->name('deleteStudent');
