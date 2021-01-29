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


Route::group(['middleware' => 'login'], function () {

    Route::group(['prefix' => 'dashboard', 'middleware' => 'checkUser'], function () {
        Route::get('/', 'Trainers\DashboardController@index')->name('home');//Это name для хлебных крошек

//    Route::get('lessons/{lesson_id}/tests', function($lesson_id) { //Подключение своего метода в ресурс
//        $controller = new App\Http\Controllers\Trainers\LessonController();
//        return $controller->getTests($lesson_id);
//    })->name('tests');
//
//    Route::get('lessons/{lesson_id}/tests/create', function($lesson_id) {
//        $controller = new App\Http\Controllers\Trainers\TestController();
//        return $controller->create($lesson_id);
//    })->name('tests.create');

        Route::resource('profile', 'Trainers\TrainerController');

        Route::get('profile/{id}/password', function ($id) {
            $controller = new App\Http\Controllers\Trainers\TrainerController();
            return $controller->formPassword($id); //Свой метод
        })->name('password');

        Route::post('profile/{id}/password', function ($id, \App\Http\Requests\PasswordRequest $request) {
           $controller = new App\Http\Controllers\Trainers\TrainerController();
           return $controller->changePassword($id, $request); //Свой метод
        });

        Route::resource('courses', 'Trainers\CourseController');

        Route::get('courses/{course_id}/members', function($course_id) {
            $controller = new App\Http\Controllers\Trainers\CourseController();
            return $controller->getListMembers($course_id);
        })->name('member_courses');

        Route::post('courses/{course_id}/members/{member_id}', function($course_id, Illuminate\Http\Request $request, $member_id) {
            $controller = new App\Http\Controllers\Trainers\CourseController();
            return $controller->updateListMembers($course_id, $request, $member_id);
        });

        Route::resource('lessons', 'Trainers\LessonController');
        Route::resource('materials', 'Trainers\MaterialController');
        Route::resource('tests', 'Trainers\TestController');
        Route::resource('questions', 'Trainers\QuestionController');
        Route::resource('tasks', 'Trainers\TaskController');
        Route::resource('members', 'Trainers\MemberController');

//        Route::post('send', function () {
//            $controller = new App\Http\Controllers\Trainers\MemberController();
//            return $controller->sendPassword();
//        });
    });

    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

//Для участников
    Route::get('/','Members\CourseController@getList');

    Route::get('/course/show/{id?}', 'Members\CourseController@getForm');
    Route::get('/course/{id?}/rating', 'Members\CourseController@getRatingCourse');

    Route::get('/course/{c_id?}/lesson/show/{l_id?}', 'Members\LessonController@getLesson');
    Route::get('/course/{c_id?}/homework/show/{h_id?}', 'Members\HomeworkController@getHomework');
    Route::get('/course/{c_id?}/test/show/{t_id?}', 'Members\TestController@show');
    Route::get('/course/{c_id?}/test/start/{t_id?}', 'Members\TestController@start');
    Route::post('/course/{c_id?}/test/getQuestion/{t_id?}', 'Members\TestController@getQuestion');

    Route::get('/profile', 'Members\ProfileController@index')->name('profile');
});

Route::get('/login', 'LoginController@index');//Для екшен формы достаточно этого(action="/login")
Route::post('authorize', 'LoginController@userAuthorize'); //Для страницы входа
Route::get('logout', 'LoginController@logout')->name('logout'); //Для выхода


//Что это?
Route::get('/start', function () {
    return view('members.start');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('/addStudiedMaterial', 'API\Materials@addStudiedMaterial');
});
