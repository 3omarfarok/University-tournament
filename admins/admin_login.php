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

// to send th data
  $username = $_POST['username'];
  $password = $_POST['password'];

// to get the data of the admin from DB
  $sql = "SELECT * FROM admins WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

// check the data that Entered
    if ($password === $row['password']) {
      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_username'] = $username;
      header("Location: admin_semiPanel.php");
      exit();
    } else {
      echo "<div class='alert alert-danger'>Invalid password.</div>";
    }
  } else {
    echo "<div class='alert alert-danger'>Invalid username.</div>";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  
  <style>
    body{
      background-color: #121212;
    }

    .container {
      max-width: 400px;
      margin-top: 100px; 
      padding: 20px;
      background-color: #2a2a2a; 
      border-radius: 5px; 
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="text-center mb-4">Admin Login</h2>
    <form action="admin_login.php" method="POST">

      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
