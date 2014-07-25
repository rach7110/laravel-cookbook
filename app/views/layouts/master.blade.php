<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div class="container">
      <h1>Laravel Cookbook Exercises!</h1>

      <div class="navbar">
        <div class="row clearfix">
          <div class="column fourth nav-btn"><a href="/">Home</a></div>
          <div class="column fourth nav-btn"><a href="/registration">Sign up</a></div>
          <div class="column fourth nav-btn"><a href="login">Login</a></div>
          <div class="column fourth nav-btn"><a href="fileform">File Upload</a></div>
        </div>
      </div>

      @yield('content')

      <div class="footer">
      </div>

    </div>
  </body>

</html>