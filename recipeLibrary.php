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
  <div class="main library">
    <div class="library-top-bar">
      <h1>Recipe Library</h1>
      <input type="text" />
    </div>

    <?php
    require('dao.php');
    $dao = new Dao();
    $recipes = $dao->getRecipeLibrary($_SESSION['user_id']);
    echo '<div class="recipe-cards">';

    foreach ($recipes as $recipe) {
      echo
      "<a href='recipe.php?id={$recipe['recipe_id']}'>" .
        "<div class='recipe-card'>" .
        "<img src='" .  htmlspecialchars($recipe['recipe_image']) . "' alt=" . htmlspecialchars($recipe['name']) . " />" .
        "<div class='column-centered'><h4>" . htmlspecialchars($recipe['name']) . "</h4></div></div></a>";
    }
    ?>
    
  </div>
  </main>
  <?php include "footer.php"; ?>
</body>

</html>