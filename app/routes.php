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

// USER REGISTRATION FORM:
Route::get('registration', function(){
  return View::make('registration');
});

// 
// *****************************************************************************
// POSTS FORM INPUTS; VALIDATATES RULES PASSED:
// START 
Route::post('registration', function(){
  $rules = array(
    'email' => 'required|email|different:username',
    'password' => 'required|same:password_confirm'    
    'name' => 'required',
  );
  // VALIDATION:  
  // Validator class (ships with Laravel) - the first argument passed to the make method is the data under validation. The second argument contains the validation rules that should be applied to the data.
  $validation = Validator::make(Input::all(), $rules);
  if ($validation->fails()){
    return Redirect::to('registration')->withErrors($validation)->withInput();
  }
 // MAKES AN INSTANCE OF A USER:
  $user = new User;
  $user->email = Input::get('email');
  $user->password = Hash::make(Input::get('password'));
  $user->name = Input::get('name');
  $user->admin = Input::get('admin') ? 1 : 0;
  if($user->save()) {
    Auth::loginUsingId($user->id);
    return Redirect::to('profile');
  } else {
    Redirect::to('registration')->withInput();
  }

  // Another way to retrieve the error messages from the validator: $messages = $validator->messages();
  // Notice that we do not have to explicitly bind the error messages to the view in our GET route. This is because Laravel will always check for errors in the session data, and automatically bind them to the view if they are available. So, it is important to note that an $errors variable will always be available in all of your views, on every request, allowing you to conveniently assume the $errors variable is always defined and can be safely used. The $errors variable will be an instance of MessageBag.
});
// END POST ROUTE
// *****************************************************************************

// HANDLES SUCCESSFUL FORM SUBMISSION:
Route::get('userresults', function(){
  return dd(Input::old());
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