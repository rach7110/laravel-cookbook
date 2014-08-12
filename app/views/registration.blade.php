@extends('layouts.master')
@section('content')
<h2>Registration</h2>
<!-- DISPLAY ALL ERROR MESSAGES -->
<!-- Could check individual attributes with $errors->get('email')  -->
<?php $messages = $errors->all('<p style="color:red">:message</p>') ?>
<?php foreach ($messages as $msg){ echo $msg; } ?>

<!-- CREATE A FORM: -->
<!-- Use Input::old to repopulate fields -->
<div class="form">
  <?= Form::open() ?>

    <?= Form::label('name', 'Name:') ?>
    <?= Form::text('name')?>
    <br/>
    
    <?= Form::label('email', 'Email:') ?>
    <?= Form::email('email', Input::old('email')) ?>
    <br/>
    
    <?= Form::label('password', 'Password:') ?>
    <?= Form::password('password') ?>
    <br/>

    <?= Form::label('password_confirm', 'Retype your password:') ?>
    <?= Form::password('password_confirm') ?>
    <br/>

    <?= Form::labqel('adimn', 'Admin: ') ?>
    <?= form::checkbox('admin', 'true', Input::old('admin')) ?>
    <br/>
    <br/>
    
    <?= Form::submit('Register') ?>

  <?= Form::close() ?>
</div>
@stop