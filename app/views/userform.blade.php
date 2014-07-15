@extends('layouts.master')
@section('content')
<h3>Howdy. Here is our form:</h3>
<h2>Registration</h2>
<!-- Display error messages -->
<?php $messages = $errors->all('<p
style="color:red">:message</p>') ?>
<?php foreach ($messages as $msg){ echo $msg; } ?>
<?= Form::open() ?>
  
  <?= Form::label('username', "Pick your username:") ?>
  <?= Form::text('username', Input::old('username')) ?>
  <br/>
  
  <?= Form::label('password', 'Pick your password:') ?>
  <?= Form::password('password') ?>
  <br/>
  <?= Form::label('password_confirm', 'Retype your password:') ?>
  <?= Form::password('password_confirm') ?>
  <br/>

  <?= Form::label('email', 'Email:') ?>
  <?= Form::email('email', Input::old('email')) ?>
  <br/>

  <?= Form::label('icecream', "Do you like ice cream?") ?>
  <?= Form::checkbox('icecream') ?>
  <br/>
  
  <?= Form::submit('Create') ?>


<?= Form::close() ?>
@stop