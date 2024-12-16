<?php 
  require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
  require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
  require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';
  $households = new Household();
  $householdsCount = $households->getHouseholds();
  $residents = new Resident();
  $maleResidents = $residents->filterByGender('Male');
  $femaleResidents = $residents->filterByGender('Female');
  $ageBelow18 = $residents->filterByAgeRange(0, 17);
  $age18to24 = $residents->filterByAgeRange(18, 24);
  $age25to59 = $residents->filterByAgeRange(25, 59);
  $seniorCitizen = $residents->filterByAgeRange(60, 1000);
  $residentsCount = $residents->getResidents();
  $officials = new Official();
  $officialsCount = $officials->getOfficials();

  function renderCard($icon, $title, $link, $count, $description)
  {
    return "
        <div class='card'>
            <div class='card-header'>
                <i class='fas $icon fa-2x mr-2'></i><a href='$link'>$title</a>
            </div>
            <div class='card-body'>
                <h2>$count</h2>
                <p>$description</p>
            </div>
        </div>";
  }