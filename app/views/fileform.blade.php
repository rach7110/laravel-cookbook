@extends('layouts.master')
@section('content')
  <h3>Howdy. Here is our form:</h3>
  <h2>File Upload:</h2>
  <!-- DISPALY ERROR MESSAGES, IF ANY: -->
  <?php $messages = $errors->all('<p style="color:red">:message</p>') ?>
  <?php
  foreach ($messages as $msg){
    echo $msg;
  }
  ?>
  <!-- CREATE A FORM: -->
  <!-- 'files' => TRUE automatically sets the enctype in the Form tag -->
  <?= Form::open(array('files' => TRUE)) ?>
    
    <?= Form::label('myfile', 'Choose File (PDF or JPG only)') ?>
    <?= Form::file('myfile') ?>
    <br/>
    <?= Form::submit('Upload') ?>

  <?= Form::close() ?>

@stop
