<?php require "includes/header.php"; ?>

<?php require "config.php"; ?>

<?php
// if the session is already set (i.e.,g if a user is already logged in) then
// if they happen on this login.php page, they will autmatically be redirected
// to the homepage. It's a security issue to let them access the login or register pages.
if(isset($_SESSION['username'])) {
  header('location: index.php');
}
// check for submit
if (isset($_POST['submit'])) {
  // ensure all required values are entered
  if ($_POST['email'] === '' || $_POST['password']  === '') {
    if ($_POST['email'] === '') {
      echo "You must enter an email";
    }
    if ($_POST['password'] === '') {
      echo "You must enter a password";
    }
  } else {
    // pull the email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // define the query to select values based on the email
    $login = $conn->query("SELECT * FROM users WHERE email = '$email'");

    // execute the query
    $login->execute();

    // fetch the data from the results of the query
    // FETCH_ASSOC will get an associative array of column name => value
    $data = $login->fetch(PDO::FETCH_ASSOC);

    // get the rowCount() of the $login query result, to be sure we have found that 
    // email address in the db. It should return 1 which is true if the email is 
    // found . We do this on $login instead of data because data will return 
    // an associative array not a row 
    if ($login->rowCount() > 0) {
      // password_verify takes the entered $password and compares it to the 
      // mypassword hash stored in the db. We get the hash by pull the value
      // from data's associative array for the mypassword key
      if(password_verify($password, $data['mypassword'])) {
        // get the username and email address from the returned data
        // and set them as session variables
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];

        // header sends a raw HTTP header
        // header MUST be called before any actual output is sent
        // in this case we change the location to the homepage/index.php
        header("location: index.php");
      } else {
        echo "password is incorrect";
      }
    } else {
      echo "email is incorrect";
    } 
  }
}

?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <!-- <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="user.name">
      <label for="floatingInput">Username</label>
    </div> -->
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account? <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>