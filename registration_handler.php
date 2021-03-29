<?php
  session_start();
  require_once 'dao.php';
  $dao = new Dao();

  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $_SESSION['errors'] = null;
  $_SESSION['register']['email'] = $email;
  $_SESSION['register']['name'] = $name;

  $email_regex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

  if(!preg_match($email_regex, $email)) {
    $dao->logger->LogDebug("email doesn't match");

     $_SESSION['errors']['non_valid_email'] = true;
  }

  if(!($password == $_POST['password2'])) {
   $_SESSION['errors']['passwords_dont_match'] = true;
  }

  // check the email 
  if($dao->emailExist($email)) {
   $_SESSION['errors']['email_found'] = true;
  }

  if (count($_SESSION['errors']) > 0) {
   $_SESSION['register']['email'] = $email;
   $_SESSION['register']['name'] = $name;
     $dao->logger->LogDebug(print_r($_SESSION,1));
     header('Location: register.php');
     exit;
  } 

  $dao->insertUser($email, $name, $password);
  header('Location: signIn.php');
     exit;




