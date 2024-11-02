<?php 
  session_start()
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resala University</title>
  <!-- Bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .breakLine {
      height: 50px;
      background-color: #f1f1f1;
      border: none;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include('./navBar.php'); ?>

  <!-- Hero section -->
  <div class="container my-5">
    <?php include('./homePage/Landing.php'); ?>
  </div>

  <hr class="breakLine">

  <!-- Tournament Panner -->
  <div class="container">
    <?php include('./homePage/Panner.php'); ?>
  </div>

  <!-- University cards -->
  <?php include('./homePage/cards.php'); ?>

  <!-- footer section -->
  <?php include('./footer.php');?>

  <!-- bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>