<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choice = $_POST["choice"];

    if ($choice == "individual") {

        header("Location: register_individual.php");
    } elseif ($choice == "team") {

        header("Location: register_team.php");
    } else {
        echo "Invalid choice. Please go back and try again.";
    }
    exit();
} else {

    header("Location: participationSelect.php");
    exit();
}
