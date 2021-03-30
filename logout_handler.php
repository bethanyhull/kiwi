<?php
  session_start();

  
   $_SESSION['authenticated'] = null;
   $_SESSION['user_id'] = null;
   $_SESSION['user_name'] = null;
     header('Location: index.php');
     exit;
  

 