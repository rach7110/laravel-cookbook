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
  return View::make('home');
	// return View::make('hello');
})->before('auth.basic');

// USER REGISTRATION FORM:
Route::get('registration', function(){
  return View::make('registration');
});

// 
// *****************************************************************************
// POSTS REGISTRATION; VALIDATATES RULES PASSED:
Route::post('registration', array('before' => 'csrf', function(){
  $rules = array(
    'email' => 'required|email|unique:users',
    'password' => 'required|same:password_confirm',   
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
}));
// END POST ROUTE
// *****************************************************************************
// LOGIN PAGE:
Route::get('login', function(){
  return View::make('login');
});

// POST LOGIN:
Route::post('login', function() {
  $user = array(
    'email' => Input::get('email'),
    'password' => Input::get('password')
    );
  // if (Auth::attempt(array('email' => $email, 'password' => $password))) {
  // return Redirect::intended('dashboard');
  // }
  if (Auth::attempt($user)) {
    return Redirect::to('profile');
  } else {
  return Redirect::to('login')->with ('login_error', 'Could not log in.');
  }
});

// PROFILE PAGE:
Route::get('profile', function(){
  if (Auth::check()) {
    return View::make('profile')->with('user', Auth::user());
  } else {
    return Redirect::to('login')->with('login_error', 'You must login first.');
  }
});

// EDIT PROFILE:
Route::get('profile-edit', function() {
  if (Auth::check()) {
  $user = Input::old() ? (object) Input::old() : Auth::user();
  return View::make('profile_edit')->with('user', $user);
  }
});

Route::post('profile-edit', function() {
  $rules = array (
    'email' => 'required|email',
    'password' => 'same:password_confirm',
    'name' => 'required'
  );
  $validation = Validator::make(Input::all(), $rules);
  if($validation->fails()) {
    return Redirect::to('profile-edit') -> withErrors($validation)->withInput();
  }
  $user = User::find(Auth::user()->id);
  $user->email = Input::get('email');
  $user->name = Input::get('name');
  if (Input::get('password')) {
    $user->password = Hash::make(Input::get('password'));
  }

  if ($user->save()) {
    return Redirect::to('profile') ->with('notify', 'Information updated!!');
  } else {
    return Redirect::to('profile-edit')->withInput();
  }
});

// LOGOUT:
Route::get('logout', function() {
  return Auth::logout();
});

//  A SECURED PAGE:
Route::get('secured', array('before' => 'auth', function()
{ return 'This is a secured page!';
}));

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