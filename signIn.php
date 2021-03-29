<?php
  session_start();
?>
<html lang="en">
<?php include "head.php"; ?>
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
          <a href="register.php">Don't have an account? Sign up here</a>
          <input type="submit" class="btn-large" value="Sign in" />
        </form>
      </div>
      <div class="spacer">

      </div>
    </div>
  </body>
</html>
