<?php
  session_start();
  require_once 'dao.php';
  $dao = new Dao();

  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];


  // check the email 
  $_SESSION['error_register_email_found'] = $dao->emailExist($email, $password);

  if ($_SESSION['error_register_email_found']) {
     header('Location: signIn.php');
     exit;
  } 

  $dao->insertUser($email, $name, $password);
  header('Location: signIn.php');
     exit;




