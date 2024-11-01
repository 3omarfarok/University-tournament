<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choose Participation Type</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


  <link rel="stylesheet" href="./select_style.css">
  <style>
  </style>
</head>

<body>
  <div class="choice-container">
    <h3>Choose Participation Type</h3>
    <p>Would you like to join as an individual or as a team?</p>
    <form method="POST" action="handle_choice.php">
      <button type="submit" name="choice" value="individual" class="btn btn-choice">Individual</button>
      <button type="submit" name="choice" value="team" class="btn btn-choice">Team</button>
      <button type="submit" name="choice" value="admin" class="btn btn-outline-light my-3">For Admins</button>
    </form> 
  </div>
</body>

</html>