<?php include 'inc/header.php'; ?>

<?php


if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $salt = 'syazzi';
  $password_encrypted = sha1($password . $salt);


  $sql = mysqli_query($conn, "SELECT * from users WHERE email = '" . $email . "' and password = '" . $password_encrypted . "' LIMIT 1");


  if (mysqli_num_rows($sql) > 0) { // mysli_num_rows chechk if there is results from query.
    $result = mysqli_fetch_array($sql);

    $_SESSION["name"] = $result["name"];
    $_SESSION["id"] = $result["id"];

    header("Location: index.php");
  } else {
    echo 'unmatched';
  }
}



?>

<h2>LOGIN</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75" method="POST">

  <div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email">
    <div class="invalid-feedback">
      <?php echo $emailErr; ?>
    </div>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">password</label>
    <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null; ?>" id="password" name="password" placeholder="Enter your password">
    <div class="invalid-feedback">
      <?php echo $passwordErr; ?>
    </div>
  </div>

  <a href="register.php">Register Now</a>

  <div class="mb-3">
    <input type="submit" name="submit" value="Sign in" class="btn btn-dark w-100">
  </div>
</form>


<?php include 'inc/footer.php' ?>