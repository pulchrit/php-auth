<?php require "includes/header.php"; ?>

<!-- give this file access to the db -->
<?php require "config.php"; ?>

<?php
  if (isset($_POST['submit'])) {
    if ($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] == '') {
      if ($_POST['email'] == '') {
        echo '<p>Please enter email</p>';
      }
      if ($_POST['username'] == '') {
        echo '<p>Please enter username</p>';
      }
      if ($_POST['password'] == '') {
        echo '<p>Please enter password</p>';
      }
    } else {
      // get values from form
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];// note: this var IS password,not mypassword

      // insert values into the db
      // PDO $conn->prepare automatically paramertierizes your variables to 
      // prevent sql injection
      // password is a protected word, so we have to use mypassword instead
      $insert = $conn->prepare("INSERT INTO users (email, username, mypassword)
        VALUES (:email, :username, :mypassword)");

        $insert->execute([
          ':email' => $email, // links the value name to the value var
          ':username'  => $username,
          // password_hash function will hash the password before storing in the db
          // PASSWORD_DEFAULT is the default hash mechanism
          ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
  }
?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
   
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">register</button>
    <h6 class="mt-3">Already have an account?  <a href="login.php">Login</a></h6>

  </form>
</main>
<?php require "includes/footer.php"; ?>
