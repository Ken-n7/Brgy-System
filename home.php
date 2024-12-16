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
  include 'C:\xampp\htdocs\BRGY SYSTEM\includes\home\getData.php';
  ?>
  <div class="container dashboard my-10">
    <div class="row">
      <!-- Total Residents Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <?php echo renderCard('fa-users', 'Total Residents', 'residents.php', count($residentsCount), 'Current residents in the barangay'); ?>
      </div>

      <!-- Households Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <?php echo renderCard('fa-home', 'Households', 'household.php', count($householdsCount), 'Total households registered'); ?>
      </div>

      <!-- Officials Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <?php echo renderCard('fa-user-tie', 'Officials', 'officials.php', count($officialsCount), 'Barangay officials currently in office'); ?>
      </div>

      <!-- Male Residents Card -->
      <div class="col-lg-6 col-md-12 mb-4">
        <?php echo renderCard('fa-male', 'Male Residents', 'residents.php?gender=male', count($maleResidents), 'Male residents in the barangay'); ?>
      </div>

      <!-- Female Residents Card -->
      <div class="col-lg-6 col-md-12 mb-4">
        <?php echo renderCard('fa-female', 'Female Residents', 'residents.php?gender=female', count($femaleResidents), 'Female residents in the barangay'); ?>
      </div>
      <!-- Below 18 Years Old -->
      <div class="col-lg-3 col-md-6 mb-4">
        <?php echo renderCard('fa-child', 'Below 18 Years Old', 'residents.php?age=below18', count($ageBelow18), 'Residents below <br> 18 years old'); ?>
      </div>

      <!-- 18 to 24 Years Old -->
      <div class="col-lg-3 col-md-6 mb-4">
        <?php echo renderCard('fa-user', '18-24 Years Old', 'residents.php?age=18-24', count($age18to24), 'Residents aged <br> 18-24 years old'); ?>
      </div>

      <!-- 25 to 59 Years Old -->
      <div class="col-lg-3 col-md-6 mb-4">
        <?php echo renderCard('fa-user', '18-24 Years Old', 'residents.php?age=25-59', count($age25to59), 'Residents aged <br> 25-59 years old'); ?>
      </div>

      <!-- 60 Years and Above -->
      <div class="col-lg-3 col-md-6 mb-4">
        <?php echo renderCard('fa-user', '60+ Years Old', 'residents.php?age=60plus', count($seniorCitizen), 'Residents aged <br> 60 years and above'); ?>
      </div>
    </div>
  </div>
  <?php include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\footer.html'; ?> 
</body>
</html>