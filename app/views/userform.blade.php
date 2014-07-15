@extends('layouts.master')
@section('content')
<h3>Howdy. Here is our form:</h3>
<h2>Registration</h2>
<?= Form::open(array('url' => 'submit', 'method' => 'get')) ?>
  <?= Form::label('username', "Pick your username:", array('class' => 'test')) ?>
  <?= Form::text('username') ?>
  <br>
  <?= Form::label('password', 'Pick your password:') ?>
  <?= Form::password('password') ?>
  <br>
  <br>
  <?= Form::submit('Create') ?>
<?= Form::close() ?>
@stop