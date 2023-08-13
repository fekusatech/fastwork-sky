<?php session_start();
if (isset($_SESSION['admin'])) {
  header('location:user/home.php');
}else{
  header('location:user/index.php');
}

