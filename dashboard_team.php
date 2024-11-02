<?php
session_start();

// looking at user Email
if (!isset($_SESSION['email'])) {
  header("Location: ./Register process/register_individual.php");
  exit();
}
// DB connection
$conn = new mysqli('localhost', 'root', '', 'resala_uni');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// to catch the user from his email
$email = $_SESSION['email'];
$sql = "SELECT * FROM teams WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
} else {
  echo "<h1>No user data found.</h1>";
  exit();
}


// to add team members
$team_name = $user['team'];
$members_sql = "SELECT * FROM teams WHERE team = '$team_name'";
$members_result = $conn->query($members_sql);

// sum the points from all members of the team
$points_sql = "SELECT SUM(points) AS total_points FROM teams WHERE team = '$team_name'";
$points_result = $conn->query($points_sql);
$total_points = 0;

if ($points_result->num_rows > 0) {
  $points_row = $points_result->fetch_assoc();
  $total_points = $points_row['total_points'] ? $points_row['total_points'] : 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #121212;
      color: #ffffff;
    }

    .team-dashboard-container {
      max-width: 800px;
      margin: 50px auto;
      background: #1e1e1e;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .welcome-header {
      font-size: 2.5rem;
      text-align: center;
      margin-bottom: 20px;
      color: #007bff;
    }

    .list-group-item {
      background-color: #2a2a2a;
      border: none;
      font-size: 1.1rem;
      color: #ffffff;
    }

    .list-group-item:hover {
      background-color: #3a3a3a;
    }

    .btn-dashboard {
      display: block;
      margin: 20px auto;
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 25px;
      text-transform: uppercase;
      font-weight: bold;
      transition: background-color 0.3s;
      text-align: center;
      font-size: 1.1rem;
    }

    .btn-dashboard:hover {
      background-color: #0056b3;
      color: #fff;
    }

    .icon {
      font-size: 3rem;
      color: #007bff;
    }
  </style>
</head>

<body>

  <?php include 'navBar.php' ?>

  <div class="team-dashboard-container">
    <h1 class="welcome-header">
      <i class="fas fa-users icon"></i>
      Welcome to Your Team, <?php echo htmlspecialchars($user['name']); ?>!
    </h1>

    <p class="text-center">Here are your team details:</p>
    <?php if ($team_name): ?>
      <ul class="list-group mt-4">
        <li class="list-group-item"><strong>Team Name:</strong> <?php echo htmlspecialchars($team_name); ?></li>
        <li class="list-group-item"><strong>Total Points:</strong> <?php echo htmlspecialchars($total_points); ?></li>
      </ul>
      
      <h3 class="mt-4">Team Members:</h3>
      <?php if ($members_result->num_rows > 0): ?>
        <ul class="list-group mt-2">
          <?php while ($member = $members_result->fetch_assoc()): ?>
            <li class="list-group-item"><?php echo htmlspecialchars($member['name']); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <p class="text-center">No team members found.</p>
      <?php endif; ?>
    <?php else: ?>
      <p class="text-center">No team information available.</p>
    <?php endif; ?>
    <a href="index.php" class="btn-dashboard text-decoration-none">Go to Home page</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>