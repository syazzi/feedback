<?php include 'inc/header.php'; ?>

<?php
$name = $email = $password = $confirm_password = '';
$nameErr = $emailErr = $passwordErr = $confirm_passwordErr = '';
$salt = 'syazzi';

//create users

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (empty($_POST['email'])) {
        $emailErr = 'Email is Required';
    } else {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    //verification email

    $emailVerification = mysqli_query($conn, "SELECT * from users WHERE email = '" . $email . "'");

    if (mysqli_num_rows($emailVerification) == 0) {
        $rows = mysqli_fetch_array($emailVerification);
    } else {
        $emailErr = 'Email exist';
    }

    

    if (empty($_POST['password'])) {
        $passwordErr = 'password is Required';
    } else {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if ($_POST['confirm_password'] !== $_POST['password']) {
        $confirm_passwordErr = 'password does not match';
    } else {
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirm_passwordErr)) {
        $password_encrypted = sha1($password . $salt);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password_encrypted')";

        if (mysqli_query($conn, $sql)) {
            header('Location: login.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}

?>

<h2>Register form</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
        <div class="invalid-feedback">
            <?php echo $nameErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
        <div class="invalid-feedback">
            <?php echo $emailErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null; ?>" id="password" name="password" placeholder="Enter your password">
        <div class="invalid-feedback">
            <?php echo $passwordErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">confirm Password</label>
        <input type="password" class="form-control <?php echo $confirm_passwordErr ? 'is-invalid' : null; ?>" id="confirm_password" name="confirm_password" placeholder="re-enter password">
        <div class="invalid-feedback">
            <?php echo $confirm_passwordErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Sign up" class="btn btn-dark w-100">
    </div>
</form>

<?php include 'inc/footer.php' ?>