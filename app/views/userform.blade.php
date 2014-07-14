@extends('layouts.master')
@section('content')
<br/>
Howdy. Here is our form:
<br/>
<h1>Registration</h1>
<?= Form::open(array('url' => 'submit', 'method' => 'get')) ?>
  <?= Form::label('username', "Pick your username:", array('class' => 'fun')) ?>
  <?= Form::text('username') ?>
  <br>
  <?= Form::label('password', 'Pick your password:') ?>
  <?= Form::password('password') ?>
  <br>
  <br>
  <?= Form::submit('Create') ?>
<?= Form::close() ?>
@stop