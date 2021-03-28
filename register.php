<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
  <body>
    <div class="register">
      <div class="column-centered sign-in-col">
        <h1>Register for Kiwi</h1>
        <form id="survey-form" method="POST" action="registration_handler.php" class="column-centered">
          <div class="form-line">
            <div class="form-group">
              <label id="name-label" for="name">Name</label>
              <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label id="email-label" for="email">Email</label>
              <input
                type="text"
                name="email"
                id="email"
                class="form-control"
                required
              />
            </div>
            </div>
          
          <div class="form-line">
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
  
            <div class="form-group">
              <label id="password2-label" for="password2">Confirm Password</label>
              <input
                type="text"
                name="password2"
                id="password2"
                class="form-control"
                required
              />
            </div>
          </div>
          <a href="signIn.html"><input type="submit" class="btn-large" value="Register" /></a>
        </form>
      </div>
      <div class="spacer">
      </div>
    </div>
  </body>
</html>
