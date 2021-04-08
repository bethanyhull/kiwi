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
    $prepminutes = $recipe['prep_time'];
    if ($prepminutes > 59) {
      $prephours = floor($prepminutes / 60);
      $prepminutes = $prepminutes % 60;
    }

    $cookminutes = $recipe['cook_time'];
    if ($cookminutes > 59) {
      $cookhours = floor($cookminutes / 60);
      $cookminutes = $cookminutes % 60;
    }

    $totalminutes = $recipe['cook_time'] + $recipe['prep_time'];
    if ($totalminutes > 59) {
      $totalhours = floor($totalminutes / 60);
      $totalminutes = $totalminutes % 60;
    }

  
    echo
    '<div class="recipe">';

    if( htmlspecialchars($recipe['recipe_image']) != "") {
      echo '<img src="' . htmlspecialchars($recipe['recipe_image']) . '" alt=' . htmlspecialchars($recipe['name']) . ' />';
    }
      
      echo '<h1>' . htmlspecialchars($recipe['name']) . '</h1>
      <p class="notes">' . htmlspecialchars($recipe['notes']) . '</p>
      <div class="info-bar">
       <div class="info-box">
         <span class="info-title">Servings</span>
         <span class="info">' . $recipe['servings'] . '</span>
       </div> 
       <div class="info-divider"></div>

       <div class="info-box">
        <span class="info-title">Prep Time</span>';
        if ($prephours) {
          echo '<span class="info">' . $prephours . ' hours</span>';
        }

        echo '<span class="info">' . $prepminutes . ' minutes</span>
      </div> 
      <div class="info-divider"></div>

      <div class="info-box">
        <span class="info-title">Cook Time</span>';

        if ($cookhours) {
          echo '<span class="info">' . $cookhours . ' hours</span>';
        }

        echo '<span class="info">' . $cookminutes . ' minutes</span>
      </div> 
      <div class="info-divider"></div>

      <div class="info-box">
        <span class="info-title">Total Time</span>';
        if ($totalhours) {
          echo '<span class="info">' . $totalhours . ' hours</span>';
        }

        echo '<span class="info">' . $totalminutes . ' minutes</span>
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