<?php
session_start();
if (isset($_SESSION['name'])) {
  $name = $_SESSION['name'];
} else {
  echo "<h1>You have no name</h1>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
<!--  bootstrap link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXhW+ALEwIH" crossorigin="anonymous">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #1c1c1c;
    }
    div{
      background-color: #2a2a2a;
    }
    
    
  </style>
</head>

<body class=" text-light d-flex align-items-center justify-content-center vh-100">

  <div class=" text-center p-4  rounded-4 shadow-lg">
    <icon class="display-4 mb-3 text-success">🎉</icon>
    <h1 class=" mb-3">You have logged in successfully!</h1>
    <h3 class=" mb-4">Welcome, <?php echo htmlspecialchars($name); ?>!</h3>
    <p class="fs-5">We're excited to have you as part of the Tournament.
      <br>
      You can now access all the features available.
    </p>
    <a href="../dashboard_team.php" class="btn btn-primary btn-lg mt-4">Go to Dashboard</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>