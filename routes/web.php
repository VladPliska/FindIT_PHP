<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');

Route::get('/login',function(){
    return view('page/login');
});

Route::get('/add-advert',function(){
    return view('page/add-advert');
});
Route::get('/admin',function(){
    return view('page/admin');
});
Route::get('/signup',function(){
    return view('page/signup');
});

Route::get('/signup/worker',function(){
    return view('page/signup/worker');
});
Route::get('/forgotPass',function(){
    return view('page/forgotPass');
});


Route::get('/signup/worker','MainController@workerSignUp');

Route::post('/signUp','MainController@signUp');

Route::get('/worker/profile','MainController@profile');

Route::post('/login','MainController@login');

Route::get('/logout','MainController@logout');

Route::post('/getCity','MainController@getCity');

Route::get('/signup/company','MainController@showSignUpCompany');

Route::post('/companySignUp','MainController@companySignUp');

Route::get('company/profile','MainController@companyProfile');

Route::get('/advert/{id}','MainController@advert');

Route::get('/checkEmail','MainController@checkEmail');

Route::post('/addAdvert','MainController@addAdvert');

Route::get('/all-advert','MainController@allAdvert');

Route::get('/company/profile','MainController@companyProfile');

Route::post('/chageOneInfo','MainController@saveImgResume');

Route::get('/worker/profile','MainController@workerProfile');

Route::post('worker/changePassword','MainController@workerChangePassword');

Route::post('worker/changeDetail','MainController@changeWorkerOtherData');

Route::post('/search','MainController@search');

Route::get('/all-company','MainController@allCompany');

Route::get('/company/{id}','MainController@companyPublicProfile');

Route::post('/changeselectAdvert','MainController@addAdvertToFavorite');

Route::get('/techology','MainController@getAllTech');

Route::post('/userChangeTechnology','MainController@changeUserTechnology');
