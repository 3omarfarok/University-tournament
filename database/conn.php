<!-- ensure the database is connected -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resala_uni";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}