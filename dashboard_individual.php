<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ./Register process/register_individual.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'resala_uni');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM individuals WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user data found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; 
            color: #ffffff; 
        }
        .dashboard-container {
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
  <?php include'navBar.php' ?>

<div class="dashboard-container">
    <h1 class="welcome-header"><i class="fas fa-user-circle icon"></i> Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <p class="text-center">Here are your account details:</p>
    <ul class="list-group mt-4">
        <li class="list-group-item"><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></li>
        <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
        <li class="list-group-item"><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></li>
        <li class="list-group-item"><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></li>
        <li class="list-group-item"><strong>Points:</strong> <?php echo htmlspecialchars($user['points']); ?></li>
    </ul>
    <a href="index.php" class="btn-dashboard text-decoration-none">Go to Home page</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
