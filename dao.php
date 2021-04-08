<?php

require_once 'KLogger.php';

class Dao
{
  

// data for heroku database 

public $server = 'us-cdbr-east-03.cleardb.com';
public $user = 'bf02553f992ce2';
public $password = 'db53a9f8';
public $db = 'heroku_319ce41dbdbdac8';



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
      $q->bindParam(":password", hash("sha256", $password . "fKd93Vmz!k*dAv5029Vkf9$3Aa"));
      $q->execute();
      $row = $q->fetchAll();
      if (count($row) > 0) {
        $this->logger->LogInfo("user found!" . print_r($row['email'],1));
        return true;
      }
        $this->logger->LogInfo("user not found");
        return false;
  
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


  public function insertUser($email, $name, $password)
  {
    $this->logger->LogInfo("inserting a new user name=[{$name}], email=[{$email}]");
    $conn = $this->getConnection();
    $saveQuery = "INSERT INTO users (email, name, password) values (:email, :name, :password)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $email);
    $q->bindParam(":name", $name);
    $q->bindParam(":password", hash("sha256", $password . "fKd93Vmz!k*dAv5029Vkf9$3Aa"));
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


public function getRecipeLibrary($user_id)
{
  $connection = $this->getConnection();
  try {
    $q = $connection->prepare("select recipe_id, name, recipe_image from recipes where user_id = :user_id");
    $q->bindParam(":user_id", $user_id);
    $q->execute();
    $rows = $q->fetchAll();
    $this->logger->LogInfo("recipes found!" . print_r($rows, 1));
  } catch (Exception $e) {
    echo print_r($e, 1);
    exit;
  }
  return $rows;
}

public function getIngredients($recipe_id)
{
  $connection = $this->getConnection();
  try {
    $q = $connection->prepare("select ingredient from ingredients where recipe_id = :recipe_id");
    $q->bindParam(":recipe_id", $recipe_id);
    $q->execute();
    $rows = $q->fetchAll();
  } catch (Exception $e) {
    echo print_r($e, 1);
    exit;
  }
  return $rows;
}


public function getRecipe($recipe_id)
{
  $this->logger->LogInfo("recipe_id = " . $recipe_id);
  $connection = $this->getConnection();
  try {
    $q = $connection->prepare("select * from recipes where recipe_id = :recipe_id");
    $q->bindParam(":recipe_id", $recipe_id);
    $q->execute();
    $rows = $q->fetch(PDO::FETCH_ASSOC);
    $this->logger->LogInfo("recipes found!" . print_r($rows, 1));
  } catch (Exception $e) {
    echo print_r($e, 1);
    exit;
  }
  return $rows;
}

public function getRecentRecipeID($user_id)
{
  $connection = $this->getConnection();
  try {
    $q = $connection->prepare("SELECT recipe_id FROM recipes WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
    $q->bindParam(":user_id", $user_id);
    $q->execute();
    $rows = $q->fetch();
    $this->logger->LogInfo("recipe_id found!" . print_r($rows, 1));
  } catch (Exception $e) {
    echo print_r($e, 1);
    exit;
  }
  return $rows['recipe_id'];
}

}
