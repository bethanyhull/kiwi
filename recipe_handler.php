<?php
session_start();


$user_id = $_SESSION['user_id'];
$name = $_POST['recipe-title'];
$notes = $_POST['recipe-notes'];
$servings = $_POST['servings'];
$prep_time = $_POST['prep-time'];
$cook_time = $_POST['cook-time'];
$directions = $_POST['directions'];
$recipe_image = $_POST['recipe_image'];

if($recipe_image == "") {
    $recipe_image == "/assets/b_w_kiwi.jpeg";
}


// check the email and password
require_once 'dao.php';
$dao = new Dao();
$dao->insertRecipe($user_id, $name, $notes, $servings, $prep_time, $cook_time, $directions, $recipe_image);
$recipe_id = $dao->getRecentRecipeID($user_id);

$index = 1;

while($_POST['ingredient' . $index]){
    $dao->insertIngredient(($_POST['ingredient' . $index]), $recipe_id);
    $index++;
};

   header("Location: recipe.php?id={$recipe_id}");
   exit;

?>
