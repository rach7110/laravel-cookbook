<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div class="container">
      <h1>Laravel Cookbook Exercises!</h1>
<!-- NAVBAR -->
      <div class="navbar">
        <div class="row clearfix">
          <div class="column fifth nav-btn"><a href="/">Home</a></div>
          <div class="column fifth nav-btn"><a href="/registration">Sign up</a></div>
          <div class="column fifth nav-btn"><a href="login">Login</a></div>
          <div class="column fifth nav-btn"><a href="profile">Profile</a></div>
          <div class="column fifth nav-btn"><a href="fileform">File Upload</a></div>
        </div>
      </div>

      @yield('content')

      <div class="footer">
        <div class="row clearfix">
          <div class="column fifth nav-btn"><a href="logout">Logout</a></div>        
        </div>
      </div>

    </div>
  
  </body>

</html>