<?php
session_start(); // Start the session to check login status
?>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="resources/css/table.css"> -->
<link rel="stylesheet" href="resources/css/assets.css">

<header class="header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="home.php">
        <img class="logo" src="resources/images/Barangay.svg.png" alt="Barangay System Logo" height="40" class="p-0 m-0">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item mr-3"><a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a></li>
          <li class="nav-item mr-3"><a class="nav-link" href="residents.php"><i class="fas fa-users"></i> Resident</a></li>
          <li class="nav-item mr-3"><a class="nav-link" href="household.php"><i class="fas fa-house-user"></i> Household</a></li>
          <li class="nav-item mr-3"><a class="nav-link" href="officials.php"><i class="fas fa-user-tie"></i> Officials</a></li>
          <b><li class="nav-item mr-5"><a class="nav-link" href="search.php"><i class="fas fa-search"></i> SEARCH</a></li></b>
        </ul>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
          <a href="includes/auth/logout.php" class="btn btn-outline-danger ml-lg-3 mr-0"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
        <?php else: ?>
          <?php header("Location: login.php"); ?>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>

