<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resources\css\table.css">
    <link rel="stylesheet" href="resources\css\forms.css">
    <title>Manage Households</title>
</head>

<body>

    <body>
        <?php
        require_once 'C:/xampp/htdocs/BRGY SYSTEM/database/Household.php';
        include 'C:\xampp\htdocs\BRGY SYSTEM\modals\forms.modal.php';
        include 'C:/xampp/htdocs/BRGY SYSTEM/assets/php/header.html';
        ?>

        <div class="container-fluid mt-4">
            <h1 class="mb-4">
                <b>HOUSEHOLD LIST</b>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHouseholdModal">Add Household</button>
            </h1>
            <div class="card">
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Household ID</th>
                                    <th>Household Name</th>
                                    <th>Household Number</th>
                                    <th>Household Income</th>
                                    <th>Household Size</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $households = new Household();
                                $householdList = $households->getHouseholds();

                                if (!empty($householdList)): ?>
                                    <p>Total Households: <?= count($householdList) ?></p>
                                    <?php foreach ($householdList as $household): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($household['HouseholdID']) ?></td>
                                            <td><?= htmlspecialchars($household['HouseholdName']) ?></td>
                                            <td><?= htmlspecialchars($household['HouseholdNumber']) ?></td>
                                            <td><?= htmlspecialchars($household['Household_Income']) ?></td>
                                            <td><?= htmlspecialchars($household['Household_Size']) ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateHouseholdModal<?= htmlspecialchars($household['HouseholdID']) ?>">
                                                                <i class="fas fa-edit" title="Update Household"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= htmlspecialchars($household['HouseholdID']) ?>">
                                                                <i class="fas fa-trash-alt" title="Delete Household"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= htmlspecialchars($household['HouseholdID']) ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= htmlspecialchars($household['HouseholdID']) ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModal">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to remove <?php echo htmlspecialchars("{$household['HouseholdName']} Household (ID: {$household['HouseholdID']})")  ?>? This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a type="button" class="btn btn-danger" id="confirmDelete" href="includes/remove_household.php?id=<?= htmlspecialchars($household['HouseholdID']) ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Household Modal -->
                                        <div class="modal fade" id="updateHouseholdModal<?= htmlspecialchars($household['HouseholdID']) ?>" tabindex="-1" role="dialog" aria-labelledby="updateHouseholdModalLabel<?= htmlspecialchars($household['HouseholdID']) ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateHouseholdModalLabel<?= htmlspecialchars($household['HouseholdID']) ?>">Update Household</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="includes/update_household.php?id=<?= htmlspecialchars($household['HouseholdID']) ?>" method="POST">
                                                            <div class="mb-3">
                                                                <label for="householdName<?= htmlspecialchars($household['HouseholdID']) ?>" class="form-label">Household Name:</label>
                                                                <input type="text" class="form-control" id="householdName<?= htmlspecialchars($household['HouseholdID']) ?>" name="householdName" value="<?= htmlspecialchars($household['HouseholdName']) ?>" required maxlength="25">
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
                                        <td colspan="6" class="text-center">No Households found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Household Modal -->
        <div class="modal fade" id="addHouseholdModal" tabindex="-1" role="dialog" aria-labelledby="addHouseholdModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addHouseholdModalLabel">Add Household</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="includes/add_household.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="householdName" class="form-label">Household Name:</label>
                                    <input type="text" class="form-control" id="householdName" name="householdName" required maxlength="25">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="householdNumber" class="form-label">Household Number:</label>
                                    <input type="text" class="form-control" id="householdNumber" name="householdNumber" required maxlength="25">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
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