<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<l>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to Tournament</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


  <link rel="stylesheet" href="./loginStyle.css">
</l>

<body>
  <div class="login-container">
    <h3 class="text-center">Login to Tournament</h3>

    <?php

    define("PASSWORD_MIN_LENGTH", 8);
    define("PASSWORD_MAX_LENGTH", 20);

    $emailError = $passwordError = "";
    $email = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = trim($_POST["email"]);
      $password = trim($_POST["password"]);


      if (empty($email)) {
        $emailError = "Please enter your email address.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter a valid email address.";
      }

      if (empty($password)) {
        $passwordError = "Please enter your password.";
      } elseif (strlen($password) < PASSWORD_MIN_LENGTH || strlen($password) > PASSWORD_MAX_LENGTH) {
        $passwordError = "Password must be between " . PASSWORD_MIN_LENGTH . " and " . PASSWORD_MAX_LENGTH . " characters.";
      }


      if (empty($emailError) && empty($passwordError)) {
        header("Location: par.php"); 
        exit();
      }
    }
    ?>

    <form id="loginForm" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($email); ?>" required>
        <div class="error-message"><?php echo $emailError; ?></div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div class="error-message"><?php echo $passwordError; ?></div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <p>Don't have an Account?  <a href="./registration.php" class="p-3"> Sign up</a></p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>