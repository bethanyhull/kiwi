<?php

require_once 'KLogger.php';

class Dao
{
  

// data for heroku database 

public $server = 'us-cdbr-east-03.cleardb.com';
public $user = 'bf02553f992ce2';
public $password = 'db53a9f8';
public $db = 'heroku_319ce41dbdbdac8';

// data for test database
  // public $server = 'localhost';
  // public $db = 'kiwi';
  // public $user = 'root';
  // public $password = "root";


  public $dsn;

  public $logger;

  
  public function __construct()
  {
    $this->logger = new KLogger("log.txt", KLogger::LOG_OPEN);  
    $this->dsn = "mysql:dbname={$this->db};host={$this->server}";
  }

  private function getConnection()
  {

    try {
      $connection = new PDO($this->dsn, $this->user, $this->password);
      $this->logger->LogDebug("Got a connection");
    } catch (PDOException $e) {
      $error = 'Connection failed: ' . $e->getMessage();
      $this->logger->LogError($error);
    }
    return $connection;
  }

  public function userExist($email, $password)
  {
    $connection = $this->getConnection();
    try {
      $q = $connection->prepare("select * from users where email = :email and password = :password");
      $q->bindParam(":email", $email);
      $q->bindParam(":password", $password);
      $q->execute();
      $row = $q->fetch();
      if ($row) {
        $this->logger->LogInfo("user found!" . print_r($row, 1));
        return $row;
      } else {
        $this->logger->LogInfo("user not found");
        return false;
      }
    } catch (Exception $e) {
      $this->logger->LogError($e);
      exit;
    }
  }

  public function emailExist($email)
  {
    $connection = $this->getConnection();
    try {
      $q = $connection->prepare("select count(*) as total from users where email = :email");
      $q->bindParam(":email", $email);
      $q->execute();
      $row = $q->fetch();
      if ($row['total'] == 1) {
        $this->logger->LogInfo("email found!" . print_r($row, 1));
        return true;
      } else {
        $this->logger->LogInfo("email not found");
        return false;
      }
    } catch (Exception $e) {
      $this->logger->LogError($e);
      exit;
    }
  }

  public function deleteComment($id)
  {
    $this->logger->LogInfo("deleting comment id [{$id}]");
    $conn = $this->getConnection();
    $deleteQuery = "delete from comment where comment_id = :id";
    $q = $conn->prepare($deleteQuery);
    $q->bindParam(":id", $id);
    $q->execute();
  }

  public function insertUser($email, $name, $password)
  {
    $this->logger->LogInfo("inserting a new user name=[{$name}], email=[{$email}]");
    $conn = $this->getConnection();
    $saveQuery = "INSERT INTO users (email, name, password) values (:email, :name, :password)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $email);
    $q->bindParam(":name", $name);
    $q->bindParam(":password", $password);
    $q->execute();
  }

  public function insertRecipe($user_id, $name, $notes, $servings, $prep_time, $cook_time, $directions, $recipe_image)
  {
    $this->logger->LogInfo("inserting a new recipe=[{$name}]");
    $this->logger->LogInfo($user_id);
    $conn = $this->getConnection();
    $saveQuery = "INSERT INTO recipes (user_id, name, notes, servings, prep_time, cook_time, directions, recipe_image) values (:user_id, :name, :notes, :servings, :prep_time, :cook_time, :directions, :recipe_image)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":user_id", $user_id);
    $q->bindParam(":name", $name);
    $q->bindParam(":notes", $notes);
    $q->bindParam(":servings", $servings);
    $q->bindParam(":prep_time", $prep_time);
    $q->bindParam(":cook_time", $cook_time);
    $q->bindParam(":directions", $directions);
    $q->bindParam(":recipe_image", $recipe_image);
    $q->execute();

  }

  public function mostRecentRecipe($user_id)
  {
    $connection = $this->getConnection();
    try {
      $q = $connection->prepare("select count(*) as total from users where email = :email and password = :password");
      $q->bindParam(":email", $email);
      $q->bindParam(":password", $password);
      $q->execute();
      $row = $q->fetch();
      if ($row['total'] == 1) {
        $this->logger->LogInfo("user found!" . print_r($row, 1));
        return true;
      } else {
        $this->logger->LogInfo("user not found");
        return false;
      }
    } catch (Exception $e) {
      $this->logger->LogError($e);
      exit;
    }
  }

  

  public function insertIngredient($ingredient, $recipe_id)
  {
    $this->logger->LogInfo("inserting a new ingredient =[{$ingredient}]");
    $conn = $this->getConnection();
    $saveQuery = "INSERT INTO ingredients (ingredient, recipe_id) values (:ingredient, :recipe_id)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":ingredient", $ingredient);
    $q->bindParam(":recipe_id", $recipe_id);
    $q->execute();
  }

  public function getComments()
  {
    $connection = $this->getConnection();
    try {
      $rows = $connection->query("select name, comment_id, comment, date_entered from comment order by date_entered desc", PDO::FETCH_ASSOC);
      
    } catch (Exception $e) {
      echo print_r($e, 1);
      exit;
    }
    return $rows;
  }

public function getRecipeLibrary($user_id)
{
  $connection = $this->getConnection();
  try {
    $rows = $connection->query("select recipe_id, name, recipe_image from recipes where user_id = $user_id", PDO::FETCH_ASSOC);
    
  } catch (Exception $e) {
    echo print_r($e, 1);
    exit;
  }
  return $rows;
}

// public function getRecipe($recipe_id)
// {
//   $this->logger->LogInfo("recipe_id = " . $recipe_id);
//   $connection = $this->getConnection();
//   try {
//     $row = $connection->query("select * from recipes where recipe_id = $recipe_id", PDO::FETCH_ASSOC);

//     $this->logger->LogInfo("recipe = " . $row);
    
//   } catch (Exception $e) {
//     echo print_r($e, 1);
//     exit;
//   }
//   return $row;
// }

public function getRecipe($recipe_id)
{
  $this->logger->LogInfo("recipe_id = " . $recipe_id);
  $connection = $this->getConnection();
  try {
    $q = $connection->prepare("select * from recipes where recipe_id = :recipe_id");
    $q->bindParam(":recipe_id", $recipe_id);
    $q->execute();
    $rows = $q->fetch();
    $this->logger->LogInfo("recipes found!" . print_r($rows, 1));
  } catch (Exception $e) {
    echo print_r($e, 1);
    exit;
  }
  return $rows;
}

// public function getRecipeLibrary($user_id)
// {
//   $this->logger->LogInfo("user_id = " . $user_id);
//   $connection = $this->getConnection();
//   try {
//     $q = $connection->prepare("select recipe_id, name, recipe_image from recipes where user_id = :user_id");
//     $q->bindParam(":user_id", $user_id);
//     $q->execute();
//     $rows = $q->fetch();
//     $this->logger->LogInfo("recipes found!" . print_r($rows, 1));
//   } catch (Exception $e) {
//     echo print_r($e, 1);
//     exit;
//   }
//   return $rows;
// }
}
