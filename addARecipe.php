<?php
  session_start();
  // if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
  //    header('Location: signIn.php');
  //    exit;
  // }
  //echo "<pre>" . print_r($_SESSION,1) . "</pre>";
?>
<html lang="en">
<?php include "head.php"; ?>
  <body>
  <?php include "navbar.php"; ?>
    <div class="main add-recipe">
      <form id="recipe-survey-form" method="POST" action="recipe_handler.php" class="recipe">
        <input
          type="text"
          id="recipe-title"
          name="recipe-title"
          placeholder="Click to add title"
          required
          class="h1"
        />
        <textarea
          id="recipe-notes"
          name="recipe-notes"
          placeholder="Recipe notes...."
          class="p notes"
        ></textarea>
        <div class="info-bar">
          <div class="info-box">
            <span class="info-title">Servings</span>
            <input type="number" id="servings" name="servings" class="info" />
          </div>
          <div class="info-divider"></div>

          <div class="info-box">
            <span class="info-title">Prep Time Minutes</span>
            <input type="number" id="prep-time" name="prep-time" class="info" />
          </div>
          <div class="info-divider"></div>

          <div class="info-box">
            <span class="info-title">Cook Time Minutes</span>
            <input type="number" id="cook-time" name="cook-time" class="info" />
          </div>
          <div class="info-divider"></div>

          <div class="info-box">
            <span class="info-title">Total Time</span>
            <span class="info">---</span>
          </div>
        </div>
        <div class="ingredient-title"><h4 class="recipe-info-header">Ingredients</h4>
          <span  id="addIngredient" class="btn">
            <i class="fas fa-plus" aria-hidden="true"></i>
          </span></div>
        
        <div class="recipe-info ingredients">
          <input
            type="text"
            id="ingredient1"
            name="ingredient1"
            class="ingredient"
          />
        </div>
        <h4 class="recipe-info-header">Directions</h4>
        <div class="recipe-info directions">
          <textarea
            id="directions"
            name="directions"
            class="direction"
          ></textarea>
        </div>
        <h4 class="recipe-info-header">Recipe Image Link</h4>
        <div class="recipe-info">
        <input
            type="text"
            id="recipe_image"
            name="recipe_image"
            class="ingredient"
          />
        </div>
        <input type="submit" class="btn-large" value="Add recipe" />
      </form>
      <footer>
        <p>&copy; 2021 Bethany Hull</p>
      </footer>
    </div>
  </body>
</html>
