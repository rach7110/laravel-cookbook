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

Route::get('userform', function(){
  return View::make('userform');
});

// Sets field requirements & validates POST input data:
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

// A route to handle a successful form submission:
Route::get('userresults', function(){
  return dd(Input::old());
  // $likes_icecream = Input::old('icecream');
  // if ($likes_icecream == true) {
  //   $answer = 'you like ice cream!';
  //   echo '<br/>';
  // } else {
  //   $answer = 'you do not like ICE CREAM??';
  // };
  // return 'Your username is ' . Input::old('username') . ', and ' . $answer;
});
