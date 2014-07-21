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

// POSTS FORM INPUTS W/ REQ'S & VALIDATATES RULES PASSED:
Route::post('userform', function(){
  $rules = array(
    'email' => 'required|email|different:username',
    'username' => 'required|min:6',
    'password' => 'required|same:password_confirm'
  );

  // VALIDATION:  
  // Validator class (ships with Laravel) - the first argument passed to the make method is the data under validation. The second argument contains the validation rules that should be applied to the data.
  $validation = Validator::make(Input::all(), $rules);
  if ($validation->fails()){
    return Redirect::to('userform')->withErrors($validation)->withInput();
  } 
  // Another way to retrieve the error messages from the validator: $messages = $validator->messages();
  // Notice that we do not have to explicitly bind the error messages to the view in our GET route. This is because Laravel will always check for errors in the session data, and automatically bind them to the view if they are available. So, it is important to note that an $errors variable will always be available in all of your views, on every request, allowing you to conveniently assume the $errors variable is always defined and can be safely used. The $errors variable will be an instance of MessageBag.

  return Redirect::to('userresults') -> withInput();
});

// HANDLES SUCCESSFUL FORM SUBMISSION:
Route::get('userresults', function(){
  return "Good job!";
});

// CONTAINS A FORM - FILE UPLOAD:
Route::get('fileform', function(){
  return View::make('fileform');
});

// POSTS FORM INPUT & VALIDATE - FILES:
// Saves file with a different filename.
// Move the file to its permanent location using the file's move() method, with the first parameter being the directory where we will save the file; the second is the new name of the file.
Route::post('fileform', function(){
  $rules = array(
    'myfile' => 'mimes:doc, pdf, jpg|max: 1000',
    'myfile' => 'image'
  );
  $validation = Validator::make(Input::all(), $rules);
  if ($validation->fails()){
    return Redirect::to('fileform') ->withErrors($validation)->withInput();
  } else {
    $file = Input::file('myfile');
    if ($file->move('files', $file ->getClientOriginalName())) {
      return "Success";
    } else {
      return "Error";
    }
  }
});