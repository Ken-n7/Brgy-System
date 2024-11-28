<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Management</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet" href="resources\css\table.css">
    <link rel="stylesheet" href="resources\css\forms.css">
</head>

<body>
    <?php
    // session_start();
    // if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    //     header('Location: login.php'); // Redirect to login page if not logged in
    //     exit();
    // }
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
    include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\header.html';
    include 'C:\xampp\htdocs\BRGY SYSTEM\modals\forms.modal.php';
    ?>
    <div class="container-fluid mt-4">
        <h1 class="mb-4">
            <b>RESIDENT LIST</b>
            <!-- Trigger Modal for Adding Resident -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResidentModal">Add Resident</button>
        </h1>
        <div>
            <div class="card">
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <?php include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\tableheader.html'; ?>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $residents = new Resident();
                                $residents = $residents->getResidents();
                                $res = [];
                                if (!empty($residents)): ?>
                                    <p class="fas fa-users" id="total">Total Residents: <?= count($residents) ?></p>
                                    <?php foreach ($residents as $residentData): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($residentData['ResidentID']) ?></td>
                                            <td><?= htmlspecialchars($residentData['LastName']) ?></td>
                                            <td><?= htmlspecialchars($residentData['FirstName']) ?></td>
                                            <td><?= htmlspecialchars($residentData['MiddleName']) ?></td>
                                            <td><?= htmlspecialchars($residentData['Age']) ?></td>
                                            <td><?= htmlspecialchars($residentData['Gender']) ?></td>
                                            <td><?= htmlspecialchars($residentData['BirthDate']) ?></td>
                                            <td><?= htmlspecialchars($residentData['Income']) ?></td>
                                            <td><?= htmlspecialchars($residentData['Zone']) ?></td>
                                            <td><?= htmlspecialchars($residentData['HouseholdName'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($residentData['HouseholdNumber'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($residentData['CivilStatus']) ?></td>
                                            <td>0<?= htmlspecialchars($residentData['ContactNumber']) ?></td>
                                            <td><?= htmlspecialchars($residentData['Occupation']) ?></td>
                                            <td style="color: <?= $residentData['VoterStatus'] == 'Registered' ? 'green' : 'red'; ?>;">
                                                <?= htmlspecialchars($residentData['VoterStatus']) ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateResidentModal<?= htmlspecialchars($residentData['ResidentID']) ?>">
                                                                <i class="fas fa-edit" title="Update Resident"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= htmlspecialchars($residentData['ResidentID']) ?>">
                                                                <i class="fas fa-trash-alt" title="Delete Resident"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= htmlspecialchars($residentData['ResidentID']) ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= htmlspecialchars($residentData['ResidentID']) ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModal">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to remove resident(<?php echo htmlspecialchars($residentData['ResidentID'] . " - " . $residentData['LastName'] . ", " . $residentData['FirstName'])  ?>)? This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a type="button" class="btn btn-danger" id="confirmDelete" href="includes/remove_resident.php?id=<?= htmlspecialchars($residentData['ResidentID']) ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Resident Modal -->
                                        <div class="modal fade" id="updateResidentModal<?= htmlspecialchars($residentData['ResidentID']) ?>" tabindex="-1" aria-labelledby="updateResidentModalLabel<?= htmlspecialchars($residentData['ResidentID']) ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Resident</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="includes/update_resident.php?id=<?= htmlspecialchars($residentData['ResidentID']) ?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="LastName">Last Name:</label>
                                                                    <input type="text" class="form-control" name="LastName" value="<?= htmlspecialchars($residentData['LastName']) ?>" required maxlength="25">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="FirstName">First Name:</label>
                                                                    <input type="text" class="form-control" name="FirstName" value="<?= htmlspecialchars($residentData['FirstName']) ?>" required maxlength="25">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="middleName">Middle Name:</label>
                                                                    <input type="text" class="form-control" id="MiddleName" name="MiddleName" value="<?php echo htmlspecialchars($residentData['MiddleName']); ?>" required maxlength="25">
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label for="age">Age:</label>
                                                                    <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($residentData['Age']); ?>" required maxlength="3">
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label for="gender">Gender:</label>
                                                                    <select class="form-control" id="gender" name="gender" value="<?= htmlspecialchars($residentData['Gender']) ?>" required>
                                                                        <option value="Male" <?php echo ($residentData['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                                        <option value="Female" <?php echo ($residentData['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                                        <option value="Other" <?php echo ($residentData['Gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="birthDate">Birth Date:</label>
                                                                    <input type="date" class="form-control" id="BirthDate" name="BirthDate" value="<?php echo htmlspecialchars($residentData['BirthDate']); ?>" required maxlength="8">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="zone">Zone:</label>
                                                                    <select class="form-control" id="zone" name="zone" value="<?php echo htmlspecialchars($residentData['Zone']); ?>">
                                                                        <option value="1" <?php echo ($residentData['Zone'] == '1') ? 'selected' : ''; ?>>1</option>
                                                                        <option value="2" <?php echo ($residentData['Zone'] == '2') ? 'selected' : ''; ?>>2</option>
                                                                        <option value="3" <?php echo ($residentData['Zone'] == '3') ? 'selected' : ''; ?>>3</option>
                                                                        <option value="4" <?php echo ($residentData['Zone'] == '4') ? 'selected' : ''; ?>>4</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="income">Income:</label>
                                                                    <input type="number" class="form-control" id="Income" name="Income" step="0.01" value="<?php echo htmlspecialchars($residentData['Income']); ?>" maxlength="15">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="civilStatus">Civil Status:</label>
                                                                    <select class="form-control" id="civilStatus" name="civilStatus">
                                                                        <option value="Single" <?php echo ($residentData['CivilStatus'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                                                        <option value="Married" <?php echo ($residentData['CivilStatus'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                                                        <option value="Divorced" <?php echo ($residentData['CivilStatus'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                                                        <option value="Widowed" <?php echo ($residentData['CivilStatus'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="contactNumber">Contact Number:</label>
                                                                    <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" value="0<?php echo htmlspecialchars($residentData['ContactNumber']); ?>" placeholder="Phone Number: 09876543210" minlength="11" maxlength="11" required pattern="\d*" size="11">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="occupation">Occupation:</label>
                                                                    <input type="text" class="form-control" id="Occupation" name="Occupation" value="<?php echo htmlspecialchars($residentData['Occupation']); ?>" maxlength="25">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="voterStatus">Voter Status:</label>
                                                                    <select class="form-control" id="voterStatus" name="voterStatus">
                                                                        <option value="Registered" <?php echo ($residentData['VoterStatus'] == 'Registered') ? 'selected' : ''; ?>>Registered</option>
                                                                        <option value="Unregistered" <?php echo ($residentData['VoterStatus'] == 'Unregistered') ? 'selected' : ''; ?>>Unregistered</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="household_id">Household:</label>
                                                                    <select class="form-control" id="householdID" name="householdID" required>
                                                                        <?php
                                                                        $households = new Household();
                                                                        $households = $households->getHouseholds();
                                                                        print_r($households);
                                                                        if (!empty($households)): ?>
                                                                            <?php foreach ($households as $household): ?>
                                                                                <option value="<?= htmlspecialchars($household['HouseholdID']) ?>" <?= $residentData['HouseholdID'] == $household['HouseholdID'] ? 'selected' : ''; ?>>
                                                                                    <?= htmlspecialchars($household['HouseholdName']) ?> Household
                                                                                </option>

                                                                            <?php endforeach ?>
                                                                        <?php else: ?>
                                                                            <option value="">None</option>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="20" class="text-center">No residents found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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