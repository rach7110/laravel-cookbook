<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
  return Redirect::to('/userform');
	// return View::make('hello');
});

// CONTAINS A FORM - USER REGISTRATION:
Route::get('userform', function(){
  return View::make('userform');
});

// SETS POSTED FORM FIELD REQ'S & VALIDATATES RULES PASSED:
Route::post('userform', function(){
  $rules = array(
    'email' => 'required|email|different:username',
    'username' => 'required|min:6',
    'password' => 'required|same:password_confirm'
  );
  $validation = Validator::make(Input::all(), $rules);
  if ($validation->fails()){
    return Redirect::to('userform')->withErrors($validation)->withInput;
  } 
  return Redirect::to('userresults') -> withInput();
});

// HANDLES SUCCESSFUL FORM SUBMISSION:
Route::get('userresults', function(){
});

// CONTAINS A FORM - FILE UPLOAD:
Route::get('fileform', function{
  return View::make('fileform');
})
