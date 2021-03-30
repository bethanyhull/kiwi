<?php
  session_start();
?>
<ul id="slide-out" class="sidenav sidenav-fixed" >
    <li><a class="nav-title" href="recipeLibrary.php"><h1>Kiwi</h1></a>
      <img
        src="https://thumbs.dreamstime.com/t/kiwi-half-27975390.jpg"
      /></li>
      <li class="nav-link">
      <a href="recipeLibrary.php"
            ><button class="btn btn-large waves-effect waves-light ">Recipe Library</button></a
          >
        </li>
        <li class="nav-link">
          <a href="addARecipe.php"
            ><button class="btn btn-large waves-effect waves-light ">Add a recipe</button></a
          >
        </li>
        <li class="nav-link">
          <a href="logout_handler.php"
            ><button class="btn btn-large waves-effect waves-light ">Log out</button></a
          >
        </li>
  </ul>
  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>