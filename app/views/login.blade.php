@extends('layouts.master')
@section('content')
<h2>Login</h2>
<?= '<span style="color:red">' . Session::get('login_error') . '</span>' ?>

<?= Form::open() ?>
<?= Form::label('email', 'Email address:') ?>
<?= Form::text('email') ?>
<br/>
<?= Form::label('password', 'Password:') ?>
<?= Form::password('password') ?>
<br/>
<?= Form::submit('Login') ?>
<?= Form::close() ?>
@stop