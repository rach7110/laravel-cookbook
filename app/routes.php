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

Route::post('userform', function(){
  return Redirect::to('userresults') -> withInput(Input::only('username', 'icecream'));
  // return Redirect::to('form')->withInput(Input::except('password'));
});

Route::get('userresults', function(){
  $likes_icecream = Input::old('icecream');
  if ($likes_icecream == true) {
    $answer = 'you like ice cream!';
    echo '<br/>';
  } else {
    $answer = 'you do not like ICE CREAM??';
  };
  return 'Your username is ' . Input::old('username') . ', and ' . $answer;
});
