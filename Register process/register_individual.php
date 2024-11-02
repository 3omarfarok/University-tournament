<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "resala_uni";


  $conn = new mysqli($servername, $username, $password, $dbname);


  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  // to get the data from user
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
  $phone = trim($_POST['phone']);
  $age = trim($_POST['age']);

  // to check data before post it
  $errors = [];
  if (empty($name)) {
    $errors['name'] = "Name is required.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address.";
  }

  if (empty($password)) {
    $errors['password'] = "Password is required.";
  }

  if (empty($phone)) {
    $errors['phone'] = "Phone number is required.";
  }

  if (empty($age)) {
    $errors['age'] = "Age is required.";
  }


  if (empty($errors)) {
    $sql = "INSERT INTO individuals (name, email, password, phone ,age) VALUES ('$name', '$email', '$password', '$phone' ,'$age')";

  // to save the name an email in a session
    if ($conn->query($sql) === TRUE) {
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      header("Location: ./welcomePage_indi.php");
      exit();
    } else {
      echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
  }

  $conn->close();
}

?>




<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Individual Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="./register_style.css">

<style>
  body {
  font-family: 'Poppins', sans-serif;
  background-color: #1c1c1c;
  color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  margin: 0;
}
</style>
</head>

<body>
  <div class="registration-container">
    <h3 class="text-center mb-4">Individual Registration</h3>
    <form method="POST">

      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control input-bg" id="name" name="name">
        <?php if (isset($errors['name'])): ?>
          <p class="text-danger"><?php echo $errors['name']; ?></p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control input-bg" id="email" name="email">
        <?php if (isset($errors['email'])): ?>
          <p class="text-danger"><?php echo $errors['email']; ?></p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control input-bg" id="password" name="password" required>
        <?php if (isset($errors['password'])): ?>
          <p class="text-danger"><?php echo $errors['password']; ?></p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label ">Phone Number</label>
        <input type="tel" class="form-control input-bg" id="phone" name="phone">
        <?php if (isset($errors['phone'])): ?>
          <p class="text-danger"><?php echo $errors['phone']; ?></p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control input-bg" id="age" name="age" min="18">
        <?php if (isset($errors['age'])): ?>
          <p class="text-danger"><?php echo $errors['age']; ?></p>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary">Register</button>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>