<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/table.css">
    <link rel="stylesheet" href="resources/css/search.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />

    <title>Search</title>
</head>

<body>
    <?php
    include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\header.php';
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
    ?>
    <div class="container-fluid mt-4">
        <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
            <div class="search">
                <span class="fas fa-search"></span>
                <input class="search-input" type="search" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                                            echo $_GET['search'];
                                                                                        } ?>" class="form-control" placeholder="Search data">
                <button type="submit" class="search-button" class="btn btn-primary"><b>SEARCH</b></button>
            </div>
        </form>
        <div>
            <div class="card">
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><?php include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\tableheader.html';  ?></tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = Database::getInstance()->getDB_Connection();
                                if (isset($_GET['search'])) {
                                    $filtervalues = $_GET['search'];
                                    $query = "SELECT * FROM resident_table WHERE CONCAT(ResidentID, LastName, FirstName, MiddleName) LIKE '%$filtervalues%'";
                                    $query_run = mysqli_query($connection,  $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $items) { ?>
                                            <tr>
                                                <td><?= $items['ResidentID'] ?></td>
                                                <td><?= $items['LastName'] ?></td>
                                                <td><?= $items['FirstName'] ?></td>
                                                <td><?= $items['MiddleName'] ?></td>
                                                <td><?= $items['Age'] ?></td>
                                                <td><?= $items['Gender'] ?></td>
                                                <td><?= $items['BirthDate'] ?></td>
                                                <td><?= $items['Zone'] ?></td>
                                                <td><?= $items['Income'] ?></td>
                                                <td><?= $items['CivilStatus'] ?></td>
                                                <td>0<?= $items['ContactNumber'] ?></td>
                                                <td><?= $items['Occupation'] ?></td>
                                                <td style="color: <?= $items['VoterStatus'] == 'Registered' ? 'green' : 'red'; ?>;">
                                                    <?= htmlspecialchars($items['VoterStatus']) ?>
                                                </td>
                                                <!-- <td><?= $items['Household_id'] ?></td> -->
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <b>
                                                <td colspan="14">NO RECORD FOUND</td>
                                            </b>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>