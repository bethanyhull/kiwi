<?php
  session_start();
?>
<html lang="en">
<?php include "head.php"; ?>
  <body>  
    <div class="register">
      <div class="column-centered sign-in-col">
        <h1>Register for Kiwi</h1>
        <form id="survey-form" method="POST" action="registration_handler.php" class="column-centered ">
          <div class="form-line">
            <div class="form-group">
              <label id="name-label" for="name">Name</label>
              <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="<?php echo isset($_SESSION['register']['name']) ? $_SESSION['register']['name'] : ''; ?>"
                required
              />
            </div>

            <div class="form-group">
              <label id="email-label" for="email">Email</label>
              <input
                type="text"
                name="email"
                id="email"
                value="<?php echo isset($_SESSION['register']['email']) ? $_SESSION['register']['email'] : ''; ?>"
                class="form-control <?php echo isset($_SESSION['errors']['non_valid_email']) ? 'validate invalid' : ''; echo isset($_SESSION['errors']['email_found']) ? 'validate invalid' : ''; ?>"
                required
              />
              <span class="helper-text" data-error="<?php echo isset($_SESSION['errors']['non_valid_email']) ? 'Please enter a valid email' : ''; echo isset($_SESSION['errors']['email_found']) ? 'Account found. Please sign in.' : ''; ?>"></span>
            </div>
            </div>
          
          <div class="form-line">
            <div class="form-group">
              <label id="password-label" for="password">Password</label>
              <input
                type="password"
                name="password"
                id="password"
                class="form-control <?php echo isset($_SESSION['errors']['passwords_dont_match']) ? 'validate invalid' : ''; ?>"
                required
              />
              <span class="helper-text" data-error="<?php echo isset($_SESSION['errors']['passwords_dont_match']) ? 'Passwords don\'t match, please try again' : ''; ?>"></span>
            </div>
  
            <div class="form-group">
              <label id="password2-label" for="password2">Confirm Password</label>
              <input
                type="password"
                name="password2"
                id="password2"
                class="form-control <?php echo isset($_SESSION['errors']['passwords_dont_match']) ? 'validate invalid' : ''; ?>"
                required
              />
            </div>
          </div>
          <input type="submit" class="btn-large" value="Register" />
        </form>
      </div>
      <div class="spacer">
      </div>
    </div>
  </body>
</html>
