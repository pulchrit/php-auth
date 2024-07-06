<?php
  // start a browser session, so we can save data to it and use that data
  // in the logic of this header page
  session_start();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Carousel template: Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="author" content="Udemy course: Mohamed Hassan"
    <meta name="author" content="Course work: Melissa Lafranchise">
    <title>Example Auth with PHP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css
" rel="stylesheet">

    <meta name="theme-color" content="#712cf9">
  </head>

  <body>

    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">auth sys</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
      
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <!-- if username is not set as a SESSION var, then display login and register -->
            <!-- this uses shorthand php syntax to allow you to write normal html
            that is surrounded by php if/else/end clauses -->
            <?php if(!isset($_SESSION['username'])) : ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
              </li>
            <!-- if username is set, just show the username -->
            <?php else : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                 if(isset($_SESSION['username'])) {
                  echo $_SESSION['username'];
                 } else {
                  echo "Username";
                 }?>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
              <!-- this is how you end a shorthand if statement! -->
              <?php endif; ?> 
            </li>
          
          </ul>
        </div>
      </div>
    </nav>
    <!-- This div is closed at the top of the footer! -->
    <div class="container marketing"> 