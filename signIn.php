<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kiwi: Recipe Manager</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="signInStyle.css" />
  </head>
  <body>
    <div class="main-div">
      <div class="column-centered sign-in-col">
        <h1>Sign in to Kiwi</h1>
        <form id="survey-form" method="POST" class="column-centered">
          <div class="form-group">
            <label id="username-label" for="username">Username</label>
            <input
              type="text"
              name="username"
              id="username"
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
          <input type="submit" class="button1 button" value="Sign in" />
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
