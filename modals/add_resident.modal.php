<link rel="stylesheet" href="resources/css/table.css">

<!-- Modal for Adding Resident -->
<div class="modal fade" id="addResidentModal" tabindex="-1" role="dialog" aria-labelledby="addResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addResidentModalLabel">Resident Registration Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="includes/residents/submit_resident.php" method="POST">
                    <!-- Name Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required maxlength="25" placeholder="Enter last name">
                        </div>
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required maxlength="25" placeholder="Enter first name">
                        </div>
                    </div>

                    <!-- Middle Name, Age, Gender -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" maxlength="25" placeholder="Enter middle name">
                        </div>
                        <div class="col-md-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" required min="1" max="120" placeholder="Age">
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Birth Date, Zone -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="zone" class="form-label">Zone</label>
                            <select class="form-control" id="zone" name="zone">
                                <option value="" disabled selected>Select zone</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>

                    <!-- Income, Civil Status -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="income" class="form-label">Income</label>
                            <input type="number" class="form-control" id="income" name="income" step="0.01" required min="0" placeholder="Enter income">
                        </div>
                        <div class="col-md-6">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select class="form-control" id="civil_status" name="civil_status">
                                <option value="" disabled selected>Select civil status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Contact Number, Occupation -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" required minlength="11" maxlength="11" pattern="\d*" placeholder="e.g., 09876543210">
                        </div>
                        <div class="col-md-6">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" maxlength="25" placeholder="Enter occupation">
                        </div>
                    </div>

                    <!-- Voter Status, Household -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="voter_status" class="form-label">Voter Status</label>
                            <select class="form-control" id="voter_status" name="voter_status">
                                <option value="" disabled selected>Select voter status</option>
                                <option value="Registered">Registered</option>
                                <option value="Non-Voter">Unregistered</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="household_id" class="form-label">Household</label>
                            <select class="form-control" id="household_id" name="household_id">
                                <option value="" disabled selected>Select household</option>
                                <?php
                                require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
                                $householdModel = new Household();
                                $households = $householdModel->getHouseholds();
                                if (!empty($households)) {
                                    foreach ($households as $household) {
                                        $id = htmlspecialchars($household['household_id']);
                                        echo "<option value='$id'>$id Household</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
