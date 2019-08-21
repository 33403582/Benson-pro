<?php 
  session_start(); 
  session_destroy(); 
  header("Location: ../");
?>
  <meta http-equiv="refresh" content="0; url=index.php">
