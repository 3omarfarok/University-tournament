<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resala Tournament</title>
  

  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .breakLine {
      height: 50px;
      background-color: #f1f1f1;
      border: none;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-top: 40px;
    }

    .card {
      width: 18rem;
      border: none;
      background-color: #2b3035;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-title {
      color: #007bff;
    }
  </style>

</head>

<body>

  <?php include './navBar.php'; ?>

<!-- Competitions cards -->
  <div class="container">
    <h1 class="text-center my-4">University Competitions</h1>


    <div class="card-container">
      <div class="card p-3 text-center">
        <div class="card-body">
          <h5 class="card-title">Coding Marathon</h5>
          <p class="card-text">Showcase your programming skills in coding competition. Prizes for the top 3 coders!</p>
        </div>
      </div>

      <div class="card p-3 text-center">
        <div class="card-body">
          <h5 class="card-title">Robotics Challenge</h5>
          <p class="card-text">Build and program robots to navigate a maze. Open to beginners and advanced students alike.</p>
        </div>
      </div>

      <div class="card p-3 text-center">
        <div class="card-body">
          <h5 class="card-title">Football Championship</h5>
          <p class="card-text">Compete with other teams and showcase your skills on the field. Trophies await the champions!</p>
        </div>
      </div>

      <div class="card p-3 text-center">
        <div class="card-body">
          <h5 class="card-title">Science Fair</h5>
          <p class="card-text">Showcase your innovative science projects and experiments. Open to all departments!</p>
        </div>
      </div>

      <div class="card p-3 text-center">
        <div class="card-body">
          <h5 class="card-title">Photography Contest</h5>
          <p class="card-text">Capture the best moments around campus. Prizes for the most creative and stunning photos!</p>
        </div>
      </div>
    </div>
  </div>

<!-- alert to join the tournament -->
  <div class="container mt-5">
    <div class="alert alert-primary text-center text-light" role="alert">
      <h4 class="alert-heading  ">Join the Tournament!</h4>
      <p>To participate in the Resala University Tournament, please log in to your account.</p>
      <hr>
      <a href="./Register process/participationSelect.php" class="btn btn-primary fw-bold ">Join</a>
    </div>
  </div>

  <!-- accordions for Info -->
  <?php include './tournament_pages/accordion.php' ?>


  <?php include './footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>