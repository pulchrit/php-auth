<?php 
  session_start(); // start session, ALWAYS
  session_unset(); // clear vars
  session_destroy(); // destroy/end the session

  header('location: index.php');

?>