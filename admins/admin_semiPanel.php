<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: admin_login.php");
  exit();
}

$conn = new mysqli('localhost', 'root', '', 'resala_uni');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $points = $_POST['points'];
    $operation = $_POST['operation'];

    if (!empty($name) && is_numeric($points)) {
        $type_query = "SELECT type FROM teams WHERE name = ?";
        $stmt = $conn->prepare($type_query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($type);
        $stmt->fetch();
        $stmt->close();

        if ($operation === 'add') {
            $points_query = "UPDATE " . ($type === 'team' ? "teams" : "individuals") . " SET points = points + ? WHERE name = ?";
        } else {
            $points_query = "UPDATE " . ($type === 'team' ? "teams" : "individuals") . " SET points = points - ? WHERE name = ?";
        }

        $stmt = $conn->prepare($points_query);
        $stmt->bind_param("is", $points, $name);

        if ($stmt->execute()) {
            $message = ($operation === 'add' ? "Points added" : "Points deducted") . " successfully!";
            $alert_class = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $alert_class = "danger";
        }

        $stmt->close();
    } else {
        $message = "Please enter valid data.";
        $alert_class = "warning";
    }
}

$teams_sql = "SELECT * FROM teams WHERE type = 'team'";
$teams_result = $conn->query($teams_sql);

$individuals_sql = "SELECT * FROM individuals";
$individuals_result = $conn->query($individuals_sql);

if (isset($_GET['logout'])) {
  session_unset();
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Points</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #ffffff;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background: #1e1e1e;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Admin Dashboard - Manage Points</h1>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $alert_class; ?> alert-dismissible fade show mt-4" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h3>Team Members</h3>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Team Name</th>
                    <th>Manage Points</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($teams_result->num_rows > 0): ?>
                    <?php while ($team_member = $teams_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($team_member['name']); ?></td>
                            <td><?php echo htmlspecialchars($team_member['points']); ?></td>
                            <td><?php echo htmlspecialchars($team_member['team']); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($team_member['name']); ?>">
                                    <input type="number" name="points" min="1" class="form-control form-control-sm d-inline w-50 me-2" required>
                                    <button type="submit" name="operation" value="add" class="btn btn-success btn-sm">Add</button>
                                    <button type="submit" name="operation" value="deduct" class="btn btn-danger btn-sm">Deduct</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No team members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Individuals</h3>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Manage Points</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($individuals_result->num_rows > 0): ?>
                    <?php while ($individual = $individuals_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($individual['name']); ?></td>
                            <td><?php echo htmlspecialchars($individual['points']); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($individual['name']); ?>">
                                    <input type="number" name="points" min="1" class="form-control form-control-sm d-inline w-50 me-2" required>
                                    <button type="submit" name="operation" value="add" class="btn btn-success btn-sm">Add</button>
                                    <button type="submit" name="operation" value="deduct" class="btn btn-danger btn-sm">Deduct</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No individuals found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="?logout=true" class="btn btn-secondary mt-3">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
