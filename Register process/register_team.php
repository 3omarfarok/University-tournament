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

  $team = trim($_POST['team']);
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
  $phone = trim($_POST['phone']);
  $age = trim($_POST['age']);

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

  if (empty($errors)) {
    $members_sql = "SELECT COUNT(*) AS member_count FROM teams WHERE team = '$team'";
    $members_result = $conn->query($members_sql);
    $member_count = $members_result->fetch_assoc()['member_count'];

    if ($member_count >= 5) {
      $errors['members'] = "<div class='alert alert-danger m-2'>The team is already full. You cannot join this team.</div>";
    } else {
      $sql = "INSERT INTO teams (name, email, password, phone, age, team) 
                    VALUES ('$name', '$email', '$password', '$phone', '$age', '$team')";

      if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header("Location: ./welcomePage_teams.php");
        exit();
      } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
      }
    }
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Registration</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./register_style.css">


</head>

<body>
  <div class="registration-container">
    <h3 class="text-center mb-4">Team Registration</h3>
    <?php if (isset($errors['members'])): ?>
      <?php echo $errors['members']; ?>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label for="team-name" class="form-label">Team Name</label>
        <select id="team-name" class="form-select" name="team" required>
          <option value="">Select Team</option>
          <option value="team1">Team 1</option>
          <option value="team2">Team 2</option>
          <option value="team3">Team 3</option>
          <option value="team4">Team 4</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <?php if (isset($errors['name'])): ?>
          <p class="text-danger"><?php echo $errors['name']; ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <?php if (isset($errors['email'])): ?>
          <p class="text-danger"><?php echo $errors['email']; ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <?php if (isset($errors['password'])): ?>
          <p class="text-danger"><?php echo $errors['password']; ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" id="phone" name="phone" required>
      </div>
      <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" id="age" name="age" min="18" required>
      </div>

      <button type="submit" class="btn btn-primary">Register</button>
    </form>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>