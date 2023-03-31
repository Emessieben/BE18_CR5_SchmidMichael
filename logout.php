<?php 

  session_start();

  // check if it is user or admin
  if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("location: index.php");
    exit;
  }

  // unset and logout, redirect to index.php
  if(isset($_GET["logout"])){
    unset($_SESSION["user"]);
    unset($_SESSION["adm"]);

    session_unset();
    session_destroy();
    header("location: index.php");
    exit;
  }
?>