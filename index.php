<?php require "includes/header.php"; ?>

<?php 
  // We can pull the username from the browser's session variables that we 
  //  set in login.php
  if(isset($_SESSION['username'])) {
    echo "hello " . $_SESSION['username'] . "!";
  } else {
    echo "hello, please register or login";
  }
  
?>

<?php require "includes/footer.php"; ?>