<?php
  session_start();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiwi: Recipe Manager</title>
    <link rel="stylesheet" href="./style/css/materialize.css">
    <link rel="stylesheet" href="./style/css/style.css">
</head>
  <body>
    <div class="sign-in">
      <div class="column-centered sign-in-col">
        <h1>Sign in to Kiwi</h1>
        <form id="sign-in-form" method="POST" action="login_handler.php" class="column-centered">
          <div class="form-group">
            <label id="email-label" for="email">email</label>
            <input
              type="text"
              name="email"
              id="email"
              class="form-control"
              required
            />
          </div>

          <div class="form-group">
            <label id="password-label" for="password">Password</label>
            <input
              type="text"
              name="password"
              id="password"
              class="form-control"
              required
            />
          </div>
          <a href="#">Forget your password?</a>
          <a href="recipeLibrary.html"><input type="submit" class="btn-large" value="Sign in" /></a>
        </form>
      </div>
      <div class="spacer">
        <!-- <img
          src="./assets/joseph-gonzalez-fdlZBWIP0aM-unsplash.jpg"
          alt="avocado toast"
        /> -->
      </div>
    </div>
  </body>
</html>
