<?php
// to delete user data if he want to logout
if (isset($_GET['logout'])) {
  session_unset();
  header("Location: index.php");
  exit();
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">
      <img src="./assets/Resala University WLogo .png" alt="University Logo" width="40" height="40"> RESALA University
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./tournamentPage.php">Our Tournament</a>
        </li>

  <!-- if he logged in this will appear -->
        <?php if (isset($_SESSION['email'])): ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dashboard
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./dashboard_individual.php">Individual</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./dashboard_team.php">Team</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>

        <!-- if he logged in this will appear -->
      <?php if (isset($_SESSION['email'])): ?>
        <div class="d-flex align-items-center ms-auto ">
          <span class="me-3 text-decoration-underline">
            <?php echo $_SESSION['name']; ?> 
          </span>
          <a href="?logout=true" class="btn btn-outline-primary ms-auto">Logout</a>
        </div>
        <!-- if he not logged in this will be the normal -->
      <?php else: ?>
        <a href="./Register process/participationSelect.php" class="btn btn-primary ms-auto">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>