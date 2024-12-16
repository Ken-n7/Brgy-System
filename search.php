<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <!-- Bootstrap CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search">
    <link rel="stylesheet" href="resources/css/table.css">
    <link rel="stylesheet" href="resources/css/forms.css">
    <link rel="stylesheet" href="resources/css/search.css">

</head>

<body>
    <?php
    include 'assets/php/header.php';
    require_once 'database/Resident.php';
    require_once 'database/Household.php';
    require_once 'database/Database.php';
    ?>

    <div class="container-fluid mt-4">
        <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
            <div class="search">
                <span class="fas fa-search"></span>
                <input class="search-input" type="search" name="search" required value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="form-control" placeholder="Search data">
                <button type="submit" class="search-button btn btn-primary"><b>SEARCH</b></button>
            </div>
        </form>

        <div class="card mt-4">
            <div class="card-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <?php include 'assets/php/tableheader.html'; ?>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = Database::getInstance()->getDB_Connection();
                            if (isset($_GET['search'])) {
                                $filtervalues = mysqli_real_escape_string($connection, $_GET['search']);
                                $query = "SELECT * FROM resident_table WHERE CONCAT(resident_id, last_name, first_name, middle_name) LIKE '%$filtervalues%'";
                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($residentData = mysqli_fetch_assoc($query_run)) {
                                        $residentId = htmlspecialchars($residentData['resident_id']);
                            ?>
                                        <tr>
                                            <td><?= htmlspecialchars($residentData['resident_id']) ?></td>
                                            <td><?= htmlspecialchars($residentData['last_name']) ?></td>
                                            <td><?= htmlspecialchars($residentData['first_name']) ?></td>
                                            <td><?= htmlspecialchars($residentData['middle_name']) ?></td>
                                            <td><?= htmlspecialchars($residentData['age']) ?></td>
                                            <td><?= htmlspecialchars($residentData['gender']) ?></td>
                                            <td><?= htmlspecialchars($residentData['birth_date']) ?></td>
                                            <td><?= htmlspecialchars($residentData['income']) ?></td>
                                            <td><?= htmlspecialchars($residentData['zone']) ?></td>
                                            <td><?= htmlspecialchars($residentData['household_name'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($residentData['house_number'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($residentData['civil_status']) ?></td>
                                            <td>0<?= htmlspecialchars($residentData['contact_number']) ?></td>
                                            <td><?= htmlspecialchars($residentData['occupation']) ?></td>
                                            <td style="color: <?= $residentData['voter_status'] == 'Registered' ? 'green' : 'red'; ?>;">
                                                <?= htmlspecialchars($residentData['voter_status']) ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateResidentModal<?= $residentId ?>">
                                                                <i class="fas fa-edit" title="Update Resident"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $residentId ?>">
                                                                <i class="fas fa-trash-alt" title="Delete Resident"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= $residentId ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $residentId ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to remove resident (<?= $residentId . " - " . htmlspecialchars($residentData['last_name'] . ', ' . $residentData['first_name']) ?>)? This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-danger" href="includes/residents/remove_resident.php?id=<?= $residentId ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Resident Modal -->
                                        <div class="modal fade" id="updateResidentModal<?= $residentId ?>" tabindex="-1" aria-labelledby="updateResidentModalLabel<?= $residentId ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Resident</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="includes/residents/update_resident.php?id=<?= $residentId ?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="last_name">Last Name:</label>
                                                                    <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars($residentData['last_name']) ?>" required maxlength="25">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="first_name">First Name:</label>
                                                                    <input type="text" class="form-control" name="first_name" value="<?= htmlspecialchars($residentData['first_name']) ?>" required maxlength="25">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="middle_name">Middle Name:</label>
                                                                    <input type="text" class="form-control" name="middle_name" value="<?= htmlspecialchars($residentData['middle_name']) ?>" required maxlength="25">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="age">Age:</label>
                                                                    <input type="number" class="form-control" name="age" value="<?= htmlspecialchars($residentData['age']) ?>" required min="0" max="150">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="gender">Gender:</label>
                                                                    <select class="form-control" name="gender" required>
                                                                        <option value="Male" <?= ($residentData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                                        <option value="Female" <?= ($residentData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                                        <option value="Other" <?= ($residentData['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="birth_date">Birth Date:</label>
                                                                    <input type="date" class="form-control" name="birth_date" value="<?= htmlspecialchars($residentData['birth_date']) ?>" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="zone">Zone:</label>
                                                                    <select class="form-control" name="zone">
                                                                        <option value="1" <?= ($residentData['zone'] == '1') ? 'selected' : ''; ?>>1</option>
                                                                        <option value="2" <?= ($residentData['zone'] == '2') ? 'selected' : ''; ?>>2</option>
                                                                        <option value="3" <?= ($residentData['zone'] == '3') ? 'selected' : ''; ?>>3</option>
                                                                        <option value="4" <?= ($residentData['zone'] == '4') ? 'selected' : ''; ?>>4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="income">Income:</label>
                                                                    <input type="number" class="form-control" name="income" step="0.01" value="<?= htmlspecialchars($residentData['income']) ?>" maxlength="15">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="civil_status">Civil Status:</label>
                                                                    <select class="form-control" name="civil_status">
                                                                        <option value="Single" <?= ($residentData['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                                                        <option value="Married" <?= ($residentData['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                                                        <option value="Divorced" <?= ($residentData['civil_status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                                                        <option value="Widowed" <?= ($residentData['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="contact_number">Contact Number:</label>
                                                                    <input type="text" class="form-control" name="contact_number" value="0<?= htmlspecialchars($residentData['contact_number']) ?>" pattern="\d{11}" required maxlength="11">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="occupation">Occupation:</label>
                                                                    <input type="text" class="form-control" name="occupation" value="<?= htmlspecialchars($residentData['occupation']) ?>" maxlength="25">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="voter_status">Voter Status:</label>
                                                                    <select class="form-control" name="voter_status">
                                                                        <option value="Registered" <?= ($residentData['voter_status'] == 'Registered') ? 'selected' : ''; ?>>Registered</option>
                                                                        <option value="Non-Voter" <?= ($residentData['voter_status'] == 'Non-Voter') ? 'selected' : ''; ?>>Non-Voter</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="household_id">Household:</label>
                                                                    <select class="form-control" name="household_id">
                                                                        <?php
                                                                        $households = (new Household())->getHouseholds();
                                                                        foreach ($households as $household) {
                                                                            $householdId = htmlspecialchars($household['household_id']);
                                                                            $householdName = htmlspecialchars($household['household_name']);
                                                                            $selected = ($residentData['household_id'] == $householdId) ? 'selected' : '';
                                                                            echo "<option value='$householdId' $selected>$householdName Household</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-3">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="14" class="text-center"><strong>No records found</strong></td>
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

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>