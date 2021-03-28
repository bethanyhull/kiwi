<?php
  session_start();

  $email = $_POST['email'];
  $password = $_POST['password'];

  // check the email and password
  require_once 'dao.php';
  $dao = new Dao();
  $row = $dao->userExist($email, $password);

  if ($row != false) {
   $_SESSION['authenticated'] = true;
   $_SESSION['user_id'] = $row['user_id'];
   $_SESSION['user_name'] = $row['name'];
     header('Location: recipeLibrary.php');
     exit;
  } else {
   $_SESSION['authenticated'] = false;
     header('Location: signIn.php');
     exit;
  }