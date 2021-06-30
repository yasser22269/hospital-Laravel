<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin', 'prefix' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('Admin');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
     // ------------------------------Start Admins----------------------------------

                Route::get('profile', 'HomeController@profile')->name('admin.profile');
                Route::put('profile/{id}', 'HomeController@updateprofile')->name('admin.update.profile');
    // ------------------------------End Admins-----------------------------------

     // ------------------------------Start Doctors---------------------------------

           Route::resource('Doctors', 'DoctorController');

    // ------------------------------End Doctors------------------------------------

    // ------------------------------Start Nurses---------------------------------

    Route::resource('Nurses', 'NurseController');

    // ------------------------------End Nurses------------------------------------

    // ------------------------------Start Patients---------------------------------

    Route::resource('Patients', 'PatientController');
    Route::post( 'getrooms', 'PatientController@getrooms' )->name( 'getrooms' );
    Route::post( 'getbeds', 'PatientController@getbeds' )->name( 'getbeds' );


    Route::resource('ChangesBed', 'ChangesBedController')->only('edit','update');


    // ------------------------------End Patients------------------------------------

    // ------------------------------Start medicines---------------------------------

    Route::resource('Medicines', 'MedicineController');

    // ------------------------------End medicines------------------------------------

    // ------------------------------Start patient_medicines---------------------------------

        Route::resource('patient_medicines', 'PatientMedicineController');

    // ------------------------------End patient_medicines------------------------------------


        // ------------------------------Start administrations---------------------------------

        Route::resource('administrations', 'AdministrationController')->only('index','update');;

    // ------------------------------End administrations------------------------------------

    Route::get('LogsPage', 'LogsController@index')->name('admin.LogsPage');


});


Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin', 'prefix' => 'Admin'], function () {

    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

});


