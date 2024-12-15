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
    <link rel="stylesheet" href="resources/css/table.css">
    <link rel="stylesheet" href="resources/css/forms.css">
</head>

<body>
    <?php
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
    include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\header.php';
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
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateResidentModal<?= htmlspecialchars($residentData['resident_id']) ?>">
                                                                <i class="fas fa-edit" title="Update Resident"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= htmlspecialchars($residentData['resident_id']) ?>">
                                                                <i class="fas fa-trash-alt" title="Delete Resident"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= htmlspecialchars($residentData['resident_id']) ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= htmlspecialchars($residentData['resident_id']) ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModal">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to remove resident(<?php echo htmlspecialchars($residentData['resident_id'] . " - " . $residentData['last_name'] . ", " . $residentData['first_name'])  ?>)? This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a type="button" class="btn btn-danger" id="confirmDelete" href="includes/residents/remove_resident.php?id=<?= htmlspecialchars($residentData['resident_id']) ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Resident Modal -->
                                        <div class="modal fade" id="updateResidentModal<?= htmlspecialchars($residentData['resident_id']) ?>" tabindex="-1" aria-labelledby="updateResidentModalLabel<?= htmlspecialchars($residentData['resident_id']) ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Resident</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="includes/residents/update_resident.php?id=<?= htmlspecialchars($residentData['resident_id']) ?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="last_name">Last Name:</label>
                                                                    <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars($residentData['last_name']) ?>" required maxlength="25">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="first_name">First Name:</label>
                                                                    <input type="text" class="form-control" name="first_name" value="<?= htmlspecialchars($residentData['first_name']) ?>" required maxlength="25">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="middle_name">Middle Name:</label>
                                                                    <input type="text" class="form-control" name="middle_name" value="<?= htmlspecialchars($residentData['middle_name']) ?>" required maxlength="25">
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label for="age">Age:</label>
                                                                    <input type="number" class="form-control" name="age" value="<?= htmlspecialchars($residentData['age']) ?>" required maxlength="3">
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label for="gender">Gender:</label>
                                                                    <select class="form-control" name="gender" required>
                                                                        <option value="Male" <?= ($residentData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                                        <option value="Female" <?= ($residentData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                                        <option value="Other" <?= ($residentData['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="birth_date">Birth Date:</label>
                                                                    <input type="date" class="form-control" name="birth_date" value="<?= htmlspecialchars($residentData['birth_date']) ?>" required>
                                                                </div>
                                                                <div class="col-md-6 form-group">
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
                                                                <div class="col-md-6 form-group">
                                                                    <label for="income">Income:</label>
                                                                    <input type="number" class="form-control" name="income" step="0.01" value="<?= htmlspecialchars($residentData['income']) ?>" maxlength="15">
                                                                </div>
                                                                <div class="col-md-6 form-group">
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
                                                                <div class="col-md-6 form-group">
                                                                    <label for="contact_number">Contact Number:</label>
                                                                    <input type="text" class="form-control" name="contact_number" value="0<?= htmlspecialchars($residentData['contact_number']) ?>" placeholder="Phone Number: 09876543210" minlength="11" maxlength="11" required pattern="\d*" size="11">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="occupation">Occupation:</label>
                                                                    <input type="text" class="form-control" name="occupation" value="<?= htmlspecialchars($residentData['occupation']) ?>" maxlength="25">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="voter_status">Voter Status:</label>
                                                                    <select class="form-control" name="voter_status">
                                                                        <option value="Registered" <?= ($residentData['voter_status'] == 'Registered') ? 'selected' : ''; ?>>Registered</option>
                                                                        <option value="Unregistered" <?= ($residentData['voter_status'] == 'Non-Voter') ? 'selected' : ''; ?>>Non-Voter</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="household_id">Household:</label>
                                                                    <select class="form-control" name="household_id">
                                                                        <?php
                                                                        $households = new Household();
                                                                        $households = $households->getHouseholds();
                                                                        if (!empty($households)): ?>
                                                                            <?php foreach ($households as $household): ?>
                                                                                <option value="<?= htmlspecialchars($household['household_id']) ?>" <?= $residentData['household_id'] == $household['household_id'] ? 'selected' : ''; ?>>
                                                                                    <?= htmlspecialchars($household['household_name']) ?> Household
                                                                                </option>
                                                                            <?php endforeach ?>
                                                                        <?php else: ?>
                                                                            <!-- <option value="">None</option> -->
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
                    <?php include 'C:\xampp\htdocs\BRGY SYSTEM\modals\forms.modal.php'; ?>
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