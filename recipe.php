<?php
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
   header('Location: signIn.php');
   exit;
}

?>
<html lang="en">
<?php include "head.php"; ?>

<body>
  <main>
  <?php include "navbar.php"; ?>
  <?php
  require('dao.php');
  $dao = new Dao();
  $recipe = $dao->getRecipe($_GET['id']);
  $ingredients = $dao->getIngredients($_GET['id']);

  ?>
  <div class="main">
    <?php
    echo
    '<div class="recipe">
      <img src="' . htmlspecialchars($recipe['recipe_image']) . '" alt=' . htmlspecialchars($recipe['name']) . ' />
      <h1>' . htmlspecialchars($recipe['name']) . '</h1>
      <p class="notes">' . htmlspecialchars($recipe['notes']) . '</p>
      <div class="info-bar">
       <div class="info-box">
         <span class="info-title">Servings</span>
         <span class="info">' . $recipe['servings'] . '</span>
       </div> 
       <div class="info-divider"></div>

       <div class="info-box">
        <span class="info-title">Prep Time</span>
        <span class="info">' . $recipe['prep_time'] . 'minutes</span>
      </div> 
      <div class="info-divider"></div>

      <div class="info-box">
        <span class="info-title">Cook Time</span>
        <span class="info">' . $recipe['cook_time'] . ' minutes</span>
      </div> 
      <div class="info-divider"></div>

      <div class="info-box">
        <span class="info-title">Total Time</span>
        <span class="info">' . $recipe['cook_time'] . ' minutes</span>
      </div> 
      

      </div>
      <h4 class="recipe-info-header">Ingredients</h4>
      <div class="recipe-info">';
    foreach ($ingredients as $ingredient) {
      echo
      '<p>' . htmlspecialchars($ingredient['ingredient']) . '</p>';
    };
    echo '</div>
      <h4 class="recipe-info-header">Directions</h4>
      <div class="recipe-info">
        <p>' . htmlspecialchars($recipe['directions']) . '</p>
      </div>
    </div>';
    ?>
  </div>
  </main>
  <?php include "footer.php"; ?>

</body>

</html>