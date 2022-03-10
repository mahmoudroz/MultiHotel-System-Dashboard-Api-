<?php

use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\ClassroomController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TermController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\dashboard\classroom_subjectcontroller;
use App\Http\Controllers\dashboard\groupcontroller;

Auth::routes();

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'cach clear success';
});


Route::get('/', function () {
    return view('auth.login');
});



Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        Route::get('/dashboard/home','HomeController@index')->name('dashboard.home')->middleware('admin');

        Route::prefix('dashboard')->namespace('Dashboard')->middleware(['auth','admin'])->name('dashboard.')->group(function () {

            Route::resource('users', 'UserController');
            Route::resource('roles', 'RoleController');
            Route::resource('hotels', 'HotelController');
            Route::resource('categories', 'CategoryController');
            Route::resource('employees', 'EmployeeController');
            Route::get('getUnitByCategoryID/{id}','EmployeeController@getUnitByCategoryID')->name('getUnitByCategoryID');
            Route::get('getRoomByFloorID/{id}','EmployeeController@getRoomByFloorID')->name('getRoomByFloorID');
            Route::get('getServiceByUnitID/{id}','EmployeeController@getServiceByUnitID')->name('getServiceByUnitID');
            Route::get('getGuestByRoomID/{id}','EmployeeController@getGuestByRoomID')->name('getGuestByRoomID');
            Route::resource('evaluations', 'EvaluationController');
            Route::resource('floors', 'FloorController');
            Route::resource('guests', 'GuestController');
            Route::resource('orders', 'OrderController');
            Route::resource('rooms', 'RoomController');
            Route::get('printQr','RoomController@printQr')->name('printQr');
            Route::resource('services', 'ServiceController');
            Route::resource('supervisors', 'SupervisorController');
            Route::resource('type_rooms', 'Type_roomController');
            Route::resource('units', 'UnitController');
            Route::resource('identity_types', 'IdentityTypeController');
            Route::resource('currencies', 'CurrencyController');
            Route::resource('payments', 'PaymentController');
            Route::resource('orders', 'OrderController');




        });


    });

