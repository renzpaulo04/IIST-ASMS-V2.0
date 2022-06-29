<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\Settings\ListFacultys;
use App\Http\Livewire\Admin\ListGenerates;
use Illuminate\Support\Facades\Route;
use Illuminate\Controllers\MainController;
use App\Http\Livewire\Admin\Settings\ListRooms;
use App\Http\Livewire\Admin\Settings\ListCourses;
use App\Http\Livewire\Admin\Settings\ListSubjects;
use App\Http\Livewire\Admin\ScheduleView\ListCourseSchedules;
use App\Http\Livewire\Admin\ScheduleView\ListFacultySchedules;
use App\Http\Livewire\Admin\ScheduleView\ListRoomSchedules;
use App\Http\Livewire\Admin\Settings\ListScheduler;
use App\Http\Livewire\Faculty\Dashboard;
use App\Http\Livewire\Faculty\FacultyAttendance;
use App\Http\Livewire\Faculty\FacultyProfile;
use App\Http\Livewire\Faculty\FacultyScheduleView;
use App\Http\Livewire\Guest\GuestDashboard;
use App\Http\Livewire\Guest\GuestProfile;
use App\Http\Livewire\Guest\Login;
use App\Http\Livewire\Pdf\FacultyPdf;
use App\Http\Livewire\Student\StudentDashboard;
use App\Http\Livewire\Student\StudentProfile;
use App\Http\Livewire\Student\StudentScheduleVIew;
use Illuminate\Support\Facades\Auth;


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
Route::get('/', function () {
    return view('auth/login');
});
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\MainController::class, 'index'])->name('home');


Route::group(['prefix'=>'admin', 'middleware'=>['isFaculty','auth','PreventBackHistory']],function(){
    Route::get('Dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('Generates', ListGenerates::class)->name('admin.generates');
    Route::get('settings/Rooms', ListRooms::class)->name('admin.rooms');
    Route::get('settings/Scheduler', ListScheduler::class)->name('admin.scheduler');
    Route::get('settings/Faculty', ListFacultys::class)->name('admin.facultys');
    Route::get('settings/Programs', ListCourses::class)->name('admin.courses');
    Route::get('settings/Subjects', ListSubjects::class)->name('admin.subjects');
    Route::get('schedule-view/Course', ListCourseSchedules::class)->name('admin.courseSchedule');
    Route::get('schedule-view/Faculty', ListFacultySchedules::class)->name('admin.facultySchedule');
    Route::get('schedule-view/Rooms', ListRoomSchedules::class)->name('admin.roomSchedule');


});
Route::group(['prefix'=>'guest', 'middleware'=>['isAdmin','auth','PreventBackHistory']],function(){
    Route::get('Dashboard', GuestDashboard::class)->name('guest.dashboard');
    Route::get('Profile', GuestProfile::class)->name('guest.profile');
});
Route::group(['prefix'=>'faculty', 'middleware'=>['isFaculty','auth','PreventBackHistory']],function(){
    Route::get('Dashboard', Dashboard::class)->name('faculty.dashboard');
    Route::get('Schedule-view', FacultyScheduleView::class)->name('faculty.schedule');
    Route::get('Profile', FacultyProfile::class)->name('faculty.profile');
    Route::get('Attendance', FacultyAttendance::class)->name('faculty.attendance');


});

Route::group(['prefix'=>'student', 'middleware'=>['isStudent','auth','PreventBackHistory']],function(){
    Route::get('Dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('Schedule', StudentScheduleVIew::class)->name('student.schedule');
    Route::get('Profile', StudentProfile::class)->name('student.profile');

});
Route::group(['prefix'=>'pdf', 'middleware'=>['isFaculty','auth','PreventBackHistory']],function(){
    Route::get('faulty-pdf', FacultyPdf::class)->name('pdf.faculty');
});
