<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';

if (isset($_GET['id'])) {
    $residentID = htmlspecialchars($_GET['id']);
    $resident = new Resident();
    $resident = $resident->getResidentID('resident_table', $residentID);

    if (!$resident) {
        header("Location: http://localhost:3000/home.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [];
        foreach ($_POST as $key => $value) {
            $formData[$key] = htmlspecialchars($value);
        }
        if (Database::getInstance()->update('resident_table', $formData, $residentID, "ResidentID")) {
            $household = new Household();
            $household->calculateHouseholdIncome();
            $household->calculateHouseholdSizes();
            header("Location: http://localhost:3000/residents.php");
            exit;
        } else {
            header("Location: http://localhost:3000/home.php");
            exit;
        }
    }
} else {
    header("Location: http://localhost:3000/officials.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Update Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/resources/css/forms.css">
</head>

<body>
    <div class="container">
        <h1>Resident Update Form</h1>
        <form action="update_resident.php?id=<?php echo htmlspecialchars($resident['ResidentID']); ?>" method="POST">
            <div class="form-group">
                <label for="LastName">Last Name:</label>
                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo htmlspecialchars($resident['LastName']); ?>" required maxlength="25">
            </div>

            <div class="form-group">
                <label for="FirstName">First Name:</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo htmlspecialchars($resident['FirstName']); ?>" required maxlength="25">
            </div>

            <div class="form-group">
                <label for="MiddleName">Middle Name:</label>
                <input type="text" class="form-control" id="MiddleName" name="MiddleName" value="<?php echo htmlspecialchars($resident['MiddleName']); ?>" required maxlength="25">
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($resident['Age']); ?>" required maxlength="3">
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <select class="form-control" id="Gender" name="Gender" required>
                    <option value="Male" <?php echo ($resident['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($resident['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo ($resident['Gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="BirthDate">Birth Date:</label>
                <input type="date" class="form-control" id="BirthDate" name="BirthDate" value="<?php echo htmlspecialchars($resident['BirthDate']); ?>" required maxlength="8">
            </div>

            <!-- <div class="form-group">
                <label for="Address">Address:</label>
                <input type="text" class="form-control" id="Address" name="Address" value="<?php echo htmlspecialchars($resident['Address']); ?>" required maxlength="50">
            </div> -->

            <div class="form-group">
                <label for="Income">Income:</label>
                <input type="number" class="form-control" id="Income" name="Income" step="0.01" value="<?php echo htmlspecialchars($resident['Income']); ?>" maxlength="15">
            </div>

            <div class="form-group">
                <label for="CivilStatus">Civil Status:</label>
                <select class="form-control" id="CivilStatus" name="CivilStatus">
                    <option value="Single" <?php echo ($resident['CivilStatus'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?php echo ($resident['CivilStatus'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                    <option value="Divorced" <?php echo ($resident['CivilStatus'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Widowed" <?php echo ($resident['CivilStatus'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ContactNumber">Contact Number:</label>
                <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" value="<?php echo htmlspecialchars($resident['ContactNumber']); ?>" placeholder="Phone Number: 09876543210" minlength="11" maxlength="11" required pattern="\d*" size="11">
            </div>

            <div class="form-group">
                <label for="Occupation">Occupation:</label>
                <input type="text" class="form-control" id="Occupation" name="Occupation" value="<?php echo htmlspecialchars($resident['Occupation']); ?>" maxlength="25">
            </div>

            <div class="form-group">
                <label for="VoterStatus">Voter Status:</label>
                <select class="form-control" id="VoterStatus" name="VoterStatus">
                    <option value="Registered" <?php echo ($resident['VoterStatus'] == 'Registered') ? 'selected' : ''; ?>>Registered</option>
                    <option value="Unregistered" <?php echo ($resident['VoterStatus'] == 'Unregistered') ? 'selected' : ''; ?>>Unregistered</option>
                </select>
            </div>

            <div class="form-group">
                <label for="household_id">Household:</label>
                <select class="form-control" id="householdID" name="householdID" required>
                    <?php
                    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
                    $households = new Household();
                    $households = $households->getHouseholds();
                    if (!empty($households)): ?>
                        <?php foreach ($households as $household): ?>
                            <option value="<?= htmlspecialchars($household['HouseholdID']) ?>"><?= htmlspecialchars($household['HouseholdName']) ?> Household</option>
                        <?php endforeach ?>
                    <?php else: ?>
                        <option value="">None</option>
                    <?php endif; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" id="btn">Submit</button>
            <a href="http://localhost:3000/residents.php" class="btn btn-secondary" id="btn">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<div class="modal fade" id="addResidentModal" tabindex="-1" role="dialog" aria-labelledby="addResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addResidentModalLabel">Resident Registration Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/submit_resident.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($resident['LastName']); ?>" required maxlength="25">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($resident['FirstName']); ?>" required maxlength="25">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo htmlspecialchars($resident['MiddleName']); ?>" required maxlength="25">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($resident['Age']); ?>" required maxlength="3">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male" <?php echo ($resident['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($resident['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo ($resident['Gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                <!-- <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="birthDate">Birth Date:</label>
                            <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?php echo htmlspecialchars($resident['BirthDate']); ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="zone">Zone:</label>
                            <select class="form-control" id="zone" name="zone">
                                <option value="Male" <?php echo ($resident['Zone'] == '1') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($resident['Zone'] == '2') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo ($resident['Zone'] == '3') ? 'selected' : ''; ?>>Other</option>
                                <option value="Other" <?php echo ($resident['Zone'] == '4') ? 'selected' : ''; ?>>Other</option>
                                <!-- <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="income">Income:</label>
                            <input type="number" class="form-control" id="income" name="income" step="0.01" value="<?php echo htmlspecialchars($resident['Income']); ?>" required maxlength="15">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="civilStatus">Civil Status:</label>
                            <select class="form-control" id="civilStatus" name="civilStatus">
                                <option value="Single" <?php echo ($resident['CivilStatus'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                <option value="Married" <?php echo ($resident['CivilStatus'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                <option value="Divorced" <?php echo ($resident['CivilStatus'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                <option value="Widowed" <?php echo ($resident['CivilStatus'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                <!-- <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="contactNumber">Contact Number:</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="<?php echo htmlspecialchars($resident['ContactNumber']); ?>" placeholder="Phone Number: 09876543210" required minlength="11" maxlength="11" pattern="\d*">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="occupation">Occupation:</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($resident['Occupation']); ?>" maxlength="25">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="voterStatus">Voter Status:</label>
                            <select class="form-control" id="voterStatus" name="voterStatus">
                                <option value="Registered" <?php echo ($resident['VoterStatus'] == 'Registered') ? 'selected' : ''; ?>>Registered</option>
                                <option value="Unregistered" <?php echo ($resident['VoterStatus'] == 'Unregistered') ? 'selected' : ''; ?>>Unregistered</option>
                                <!-- <option value="Registered">Registered</option>
                                <option value="Unregistered">Unregistered</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>