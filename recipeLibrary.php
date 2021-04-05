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
      if( htmlspecialchars($recipe['recipe_image']) == "") {
        $image = "/assets/antique-engraving-illustration-kiwi-fruit-collection-hand-draw-vintage-style-black-white-clip-art-isolated_67600-13.jpg";
      }
      else {
        $image = htmlspecialchars($recipe['recipe_image']);
      }
      echo
      "<a href='recipe.php?id={$recipe['recipe_id']}'>" .
        "<div class='recipe-card'>" .
        "<img src='" .  $image . "' alt=" . htmlspecialchars($recipe['name']) . " />" .
        "<div class='column-centered'><h4>" . htmlspecialchars($recipe['name']) . "</h4></div></div></a>";
    }
    ?>
    
  </div>
  </main>
  <?php include "footer.php"; ?>
</body>

</html>