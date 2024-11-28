<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Picture Upload and Delete Profile</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding-top: 60px; /* Add space for the fixed navbar */;
      background-color: #e7be08;
    }
    /* Fixed navbar on top */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 999;
      padding-top: 20;
      padding-bottom: 0.5rem;
      background-color: #343a40;
    }
    .navbar .navbar-brand {
      padding-top: 15;
      color: white;
    }
    .profile-card {
      text-align: center;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
      position: relative;
      margin-top: 80px; /* Add margin to avoid content overlap */
    }
    .profile-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #007bff;
      margin-bottom: 15px;
    }
    .profile-info {
      margin-top: 15px;
      font-size: 16px;
      color: #555;
    }
    .profile-info span {
      font-weight: bold;
      color: #333;
    }
    button {
      background-color: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background-color: #0056b3;
    }
    .upload-button {
      margin-top: 15px;
    }
    input[type="file"] {
      display: none;
    }
    .picture-container {
      position: relative;
      display: inline-block;
    }
    .delete-btn {
      position: absolute;
      top: -10px;
      right: -10px;
      background: red;
      color: white;
      border-radius: 50%;
      padding: 5px 10px;
      cursor: pointer;
      font-size: 12px;
    }
    .delete-profile-btn {
      background-color: #dc3545;
      margin-top: 20px;
    }
    .delete-profile-btn:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>
    <?php 
        include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\header.html';
    ?> 
  <div class="profile-card" id="profile-card">
    <div class="picture-container">
      <img id="profile-picture" src="profile.jpg" alt="Person Picture">
      <div class="delete-btn" onclick="deletePicture()">X</div>
    </div>
    <div class="profile-info">
      <p><span>Name:</span> John Doe</p>
      <p><span>Age:</span> 28</p>
      <p><span>Address:</span> 123 Main Street, Cityville</p>
      <p><span>Sex:</span> Male</p>
    </div>
    <button class="upload-button" onclick="document.getElementById('file-input').click()">Upload New Picture</button>
    <input type="file" id="file-input" accept="image/*" onchange="uploadPicture(event)">
    <button class="delete-profile-btn" onclick="deleteProfile()">Delete Profile</button>
  </div>

  <!-- Button to trigger modal -->
  <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#addOfficialModal">Add Official</button>

  <!-- Modal -->
  <div class="modal fade" id="addOfficialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Official</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="add_official.php" method="POST">
            <div class="form-group">
              <label for="officialid">Official's ID number</label>
              <input type="text" class="form-control" id="officialidNumber" name="officialidNumber" placeholder="Enter ID number" required>
            </div>
            <div class="form-group">
              <label for="officialFirstName">First Name</label>
              <input type="text" class="form-control" id="officialFirstName" name="officialFirstName" placeholder="Enter first name" required>
            </div>
            <div class="form-group">
              <label for="officialLastName">Last Name</label>
              <input type="text" class="form-control" id="officialLastName" name="officialLastName" placeholder="Enter last name" required>
            </div>
            <div class="form-group">
              <label for="officialPosition">Position</label>
              <input type="text" class="form-control" id="officialPosition" name="officialPosition" placeholder="Enter position" required>
            </div>
            <div class="form-group">
              <label for="officialContact">Contact Number</label>
              <input type="text" class="form-control" id="officialContactNumber" name="officialContactNumber" placeholder="Enter contact number" required>
            </div>
            <div class="form-group">
              <label for="officialTermStart">Term Start</label>
              <input type="date" class="form-control" id="officialTermStart" name="officialTermStart" placeholder="Enter term start" required>
            </div>
            <div class="form-group">
              <label for="officialTermEnd">Term End</label>
              <input type="date" class="form-control" id="officialTermEnd" name="officialTermEnd" placeholder="Enter term end" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Official</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    // Function to upload a new picture
    function uploadPicture(event) {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = function(e) {
        document.getElementById('profile-picture').src = e.target.result;
        document.querySelector('.delete-btn').style.display = 'block';
      };

      if (file) {
        reader.readAsDataURL(file);
      }
    }

    // Function to delete the profile picture
    function deletePicture() {
      document.getElementById('profile-picture').src = '';
      document.querySelector('.delete-btn').style.display = 'none';
    }

    // Function to delete the entire profile container
    function deleteProfile() {
      const profileCard = document.getElementById('profile-card');
      profileCard.remove(); // Removes the entire profile container from the DOM
    }
  </script>
</body>
</html>
