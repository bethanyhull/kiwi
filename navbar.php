<?php
  session_start();
?>
<ul id="slide-out" class="sidenav sidenav-fixed" >
<?php
    $full_name = $_SERVER['PHP_SELF'];
    $name_array = explode('/',$full_name);
    $count = count($name_array);
    $page_name = $name_array[$count-1];
?>
    <li><a class="nav-title" href="recipeLibrary.php"><h1>Kiwi</h1></a>
      <img
        src="https://thumbs.dreamstime.com/t/kiwi-half-27975390.jpg"
      /></li>
      <li class="nav-link">
      <a href="recipeLibrary.php"
            ><button class="btn btn-large waves-effect waves-light <?php echo ($page_name=='recipeLibrary.php')?'active':'';?>">Recipe Library</button></a
          >
        </li>
        <li class="nav-link">
          <a href="addARecipe.php"
            ><button class="btn btn-large waves-effect waves-light <?php echo ($page_name=='addARecipe.php')?'active':'';?>">Add a recipe</button></a
          >
        </li>
        <li class="nav-link">
          <a href="logout_handler.php"
            ><button class="btn btn-large waves-effect waves-light ">Log out</button></a
          >
        </li>
  </ul>
  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>