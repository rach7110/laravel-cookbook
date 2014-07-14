Howdy. Here is our form:
<br/>
<h1>Registration</h1>
  <?= Form::open() ?>
    <?= Form::label('username', "Pick your Username") ?>
    <?= Form::text('username') ?>
    <br>
    <?= Form::label('password', 'Pick your password') ?>
    <?= Form::password('password') ?>
    <br>
    <?= Form::submit('Create') ?>
  <?= Form::close() ?>