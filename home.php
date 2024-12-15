<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
  <link rel="stylesheet" href="resources/css/home.css">
  <title>Home</title>
</head>

<body>
  <?php
  include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\header.php';
  require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
  require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
  require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';
  $households = new Household();
  $households = $households->getHouseholds();
  $residents = new Resident();
  $residents = $residents->getResidents();
  $officials = new Official();
  $officials = $officials->getOfficials();
  ?>

  <div class="container dashboard my-10">
    <div class="row">

      <!-- Total Residents Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-users fa-2x mr-2"></i><a href="residents.php">Total Residents</a>
          </div>
          <div class="card-body">
            <h2><?= count($residents) ?></h2>
            <p>Current residents in the barangay</p>
          </div>
        </div>
      </div>

      <!-- Households Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-home fa-2x mr-2"></i><a href="household.php">Households</a>
          </div>
          <div class="card-body">
            <h2><?= count($households) ?></h2>
            <p>Total households registered</p>
          </div>
        </div>
      </div>

      <!-- Officials Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-user-tie fa-2x mr-2"></i><a href="officials.php"> Officials</a>
          </div>
          <div class="card-body">
            <h2><?= count($officials) ?></h2>
            <p>Barangay officials currently in office</p>
          </div>
        </div>
      </div>

      <!-- Recent Activities Card -->
      <!-- <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-calendar-alt fa-2x mr-2"></i><a href="activity.php">Recent Activities</a>
          </div>
          <div class="card-body">
            <h2>24</h2>
            <p>Community events <br> this month</p>
          </div>
        </div>
      </div> -->
      <!-- Male Residents Card -->
      <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-male fa-2x mr-2"></i><a href="residents.php?gender=male">Male Residents</a>
          </div>
          <div class="card-body">
            <h2><?= count(array_filter($residents, function ($resident) {
                  return $resident['gender'] === 'Male';
                })) ?></h2>
            <p>Male residents in the barangay</p>
          </div>
        </div>
      </div>

      <!-- Female Residents Card -->
      <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-female fa-2x mr-2"></i><a href="residents.php?gender=female">Female Residents</a>
          </div>
          <div class="card-body">
            <h2><?= count(array_filter($residents, function ($resident) {
                  return $resident['gender'] === 'Female';
                })) ?></h2>
            <p>Female residents in the barangay</p>
          </div>
        </div>
      </div>
      <!-- Below 18 Years Old -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-child fa-2x mr-2"></i><a href="residents.php?age=below18">Below 18 Years Old</a>
          </div>
          <div class="card-body">
            <h2><?= count(array_filter($residents, function ($resident) {
                  return isset($resident['Age']) && $resident['Age'] < 18;
                })) ?></h2>
            <p>Residents below <br> 18 years old</p>
          </div>
        </div>
      </div>

      <!-- 18 to 24 Years Old -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-user fa-2x mr-2"></i><a href="residents.php?age=18-24">18-24 Years Old</a>
          </div>
          <div class="card-body">
            <h2><?= count(array_filter($residents, function ($resident) {
                  return isset($resident['Age']) && $resident['Age'] >= 18 && $resident['Age'] <= 24;
                })) ?></h2>
            <p>Residents aged <br> 18-24 years old</p>
          </div>
        </div>
      </div>

      <!-- 25 to 59 Years Old -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-user fa-2x mr-2"></i><a href="residents.php?age=25-59">25-59 Years Old</a>
          </div>
          <div class="card-body">
            <h2><?= count(array_filter($residents, function ($resident) {
                  return isset($resident['Age']) && $resident['Age'] >= 25 && $resident['Age'] <= 59;
                })) ?></h2>
            <p>Residents aged <br>25-59 years old</p>
          </div>
        </div>
      </div>

      <!-- 60 Years and Above -->
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-user fa-2x mr-2"></i><a href="residents.php?age=60plus">60+ Years Old</a>
          </div>
          <div class="card-body">
            <h2><?= count(array_filter($residents, function ($resident) {
                  return isset($resident['Age']) && $resident['Age'] >= 60;
                })) ?></h2>
            <p>Residents aged <br> 60 years and above</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>