<link rel="stylesheet" href="resources\css\forms.css">

<!-- Modal for Adding Resident -->
<div class="modal fade" id="addResidentModal" tabindex="-1" role="dialog" aria-labelledby="addResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addResidentModalLabel">Resident Registration Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>
            <div class="modal-body">
                <form action="includes/submit_resident.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required maxlength="25">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required maxlength="25">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" required maxlength="25">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age" required maxlength="3">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="birthDate">Birth Date:</label>
                            <input type="date" class="form-control" id="birthDate" name="birthDate" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="zone">Zone:</label>
                            <select class="form-control" id="zone" name="zone">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="income">Income:</label>
                            <input type="number" class="form-control" id="income" name="income" step="0.01" required maxlength="15">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="civilStatus">Civil Status:</label>
                            <select class="form-control" id="civilStatus" name="civilStatus">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="contactNumber">Contact Number:</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="Phone Number: 09876543210" required minlength="11" maxlength="11" pattern="\d*">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="occupation">Occupation:</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" maxlength="25">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="voterStatus">Voter Status:</label>
                            <select class="form-control" id="voterStatus" name="voterStatus">
                                <option value="Registered">Registered</option>
                                <option value="Unregistered">Unregistered</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
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