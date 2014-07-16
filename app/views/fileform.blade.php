@extends('master.layout')
@section('content')
<h3>Howdy. Here is our form:</h3>
<h2>File Upload:</h2>
<!-- CREATE A FORM: -->
<!-- 'files' => TRUE automatically sets the enctype in the Form tag; -->
<?= Form::open(array('files' => TRUE)) ?>
  
  <?= Form::label('myfile', 'My File') ?>
  <?= Form::file('myfile') ?>
  <br/>
  <?= Form::submit('Upload') ?>

<?= Form::close() ?>
