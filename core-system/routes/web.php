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


Route::get('image/{dir}/{filename}', 'Controller@getImage')->name('image.show');   // Show Photo

Route::group(['prefix' => 'admin', 'namespace' => 'backend'], function ($route) {
    Route::group(['namespace' => 'Auth'], function () {
        //Admin Login
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login')->name('admin.login');
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

        //Admin Passwords
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.send.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.reset');
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.reset');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.reset.form');



    });


    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::resource('admins', 'AdminController');
        Route::resource('patients', 'PatientController');
        Route::resource('claims', 'ClaimController');
        Route::resource('plans', 'PlanController');
        Route::resource('services', 'ServiceController');
        Route::get('money/claims', 'ClaimController@claimsForMoney')->name('admin.claims.money');
        Route::get('money/claims/{id}', 'ClaimController@confirmPayment')->name('admin.confirm.payment');
        Route::post('payment/store', 'ClaimController@saveTransaction')->name('admin.saveTransaction');
        Route::post('payment/reject', 'ClaimController@rejectTransaction')->name('admin.rejectTransaction');

        Route::get('transactions', 'TransactionController@getAdminTransactions')->name('admin.transactions');
        Route::get('hp/transactions', 'TransactionController@getHPTransactions')->name('hp.transactions');

        Route::get('change-password', 'AdminController@changePassword')->name('change.password');
        Route::post('change-pass', 'AdminController@doChangePass')->name('change.pass');

        

    });

});
