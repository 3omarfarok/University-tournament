<?php
session_start();


$conn = new mysqli('localhost', 'root', '', 'resala_uni');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// معالجة إضافة النقاط
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $points = $_POST['points'];

    if (!empty($name) && is_numeric($points)) {
        // التحقق مما إذا كانت الإضافة لفريق أو فرد بناءً على عمود "type" في قاعدة البيانات
        $type_query = "SELECT type FROM teams WHERE name = ?";
        $stmt = $conn->prepare($type_query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($type);
        $stmt->fetch();
        $stmt->close();


        if ($type === 'team') {
            $update_sql = "UPDATE teams SET points = points + ? WHERE name = ?";
        } else{
            $update_sql = "UPDATE individuals SET points = points + ? WHERE name = ?";
        }

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("is", $points, $name);

        if ($stmt->execute()) {
            echo "<script>alert('Points added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding points: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please enter valid data.');</script>";
    }
}


$teams_sql = "SELECT * FROM teams WHERE type = 'team'";
$teams_result = $conn->query($teams_sql);


$individuals_sql = "SELECT * FROM individuals";
$individuals_result = $conn->query($individuals_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Add Points</title>
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
        .table {
            background-color: #2a2a2a;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Admin Dashboard - Add Points</h1>

        <h3>Team Members</h3>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Add Points</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($teams_result->num_rows > 0): ?>
                    <?php while ($team_member = $teams_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($team_member['name']); ?></td>
                            <td><?php echo htmlspecialchars($team_member['points']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($team_member['name']); ?>">
                                    <input type="number" name="points" min="1" required>
                                    <button type="submit" class="btn btn-success btn-sm">Add</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No team members found.</td>
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
                    <th>Add Points</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($individuals_result->num_rows > 0): ?>
                    <?php while ($individual = $individuals_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($individual['name']); ?></td>
                            <td><?php echo htmlspecialchars($individual['points']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($individual['name']); ?>">
                                    <input type="number" name="points" min="1" required>
                                    <button type="submit" class="btn btn-success btn-sm">Add</button>
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

        <a href="index.php" class="btn btn-secondary mt-3">Go to Home page</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
