<?php
session_start();
require_once './data/dbconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  // Fetch the product details from the database
  $sql = "SELECT * FROM `patients`";
  $result = mysqli_query($con, $sql);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CWOP Patient Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
    #patientTable_wrapper {
    width: 100% !important;
    }
    </style>
  </head>
  <body>
    <main>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>   
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <div class="d-flex flex-row">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark fixed-top" style="width: 280px; height: 100%;">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4" width="40">CWOP System</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link text-white" aria-current="page">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Patient Management
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" style="width: 100%;">
                          <li><a class="dropdown-item text-dark" href="patients.php">View All Patients</a></li>
                          <li><a class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patient</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Staff Management
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" style="width: 100%;">
                            <li><a class="dropdown-item text-dark" href="#">View All Personnels</a></li>
                            <li><a class="dropdown-item text-dark" href="#">View Doctors</a></li>
                            <li><a class="dropdown-item text-dark" href="#">View Partners</a></li>
                            <li><a class="dropdown-item text-dark" href="#">View Non-Ministry Personnels</a></li>
                            <li><a class="dropdown-item text-dark" href="#">View Ministry Personnels</a></li>
                        </ul>
                    </li>
            </div>
    
            <div class="d-flex flex-column flex-fill p-5 bg-light" style="width: auto; margin-left: 15%;">
                <div class="container-fluid">
                    <h1>Welcome, Admin</h1>
                    <h6>Welcome to the Dashboard for Community Wellness Outreach Program 2025</h6>
                </div>
                <div class="container-fluid mt-5">
                    <h5>General Results</h5>
                    <hr>
                    <div class="d-flex flex-row flex-fill justify-content-start">
                        <div class="card me-3" style="width: 25rem;">
                            <div class="card-body">
                              <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Patients</h6>
                              <h1 class="card-title">2,500</h1>
                            </div>
                          </div>
                          <div class="card me-3" style="width: 25rem;">
                            <div class="card-body">
                                <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Doctors</h6>
                                <h1 class="card-title">2,500</h1>
                            </div>
                          </div>
                          <div class="card" style="width: 25rem;">
                            <div class="card-body">
                                <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Partners</h6>
                                <h1 class="card-title">2,500</h1>
                            </div>
                          </div>
                    </div>
                </div>

                <div class="container-fluid mt-5">
                    <h5>Detailed Results</h5>
                    <hr>
                    <div class="d-flex flex-row justify-content-center">
                        <table class="table table-hover w-100" id="patientTable">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Services</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
      
                            <?php
        // Loop through each row of the result and display the data in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['services'] . "</td>";
            echo "<td>" . ($row['status'] == 0 ? 'Done' : 'Ongoing') . "</td>";
            echo '<td><a data-bs-toggle="modal" data-bs-target="#editPatientModel"?id=' . $row['ID'] . ' style="color: Blue; font-size: 15px; text-decoration: none; background-color: none;">Edit</a>    <a href="deleteuser.php?id=' . $row['ID'] . '" onclick="return confirm(\'Are you sure?\')" style="color: Red; font-size: 15px; text-decoration: none; background-color: none;">Delete</a></td>';

            
         
      }
      ?>
                          </table>
                    </div>
                </div>
                <script>
                  $(document).ready(function() {
                    $('#patientTable').DataTable({
                    responsive: true,
                    autoWidth: false, // Forces full width
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 5,
                    language: {
                        search: "Search Patients:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ patients"
                    }
                });
            });
              </script>


        <div class="container-fluid mt-5">
        <!-- Add Modal -->
        <div class="modal fade" id="addPatientModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
          <div class="f-flex flex-column">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Community Wellness Outreach Program</h1>
            <small>Add Patients</small>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
          <form method="POST" action="">
            <div class="d-flex flex-row mb-3">
              <h6>Medical Information Needed</h6>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">First Name</span>
              <input type="text" name="firstName"  aria-label="First name" class="form-control">
              <span class="input-group-text">Last Name</span>
              <input type="text" name="lastName" aria-label="Last name" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Age</span>
              <input type="text" name="age" aria-label="Age" class="form-control">
            </div>
            <div class="d-flex flex-row mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
              <label class="form-check-label" for="flexRadioDefault1">
                Male
              </label>
            </div>
            <div class="form-check ms-3">
              <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
              <label class="form-check-label" for="flexRadioDefault2">
                Female
              </label>
            </div>
          </div>
            <div class="d-flex flex-row mb-3">
              <select class="form-select" name="service" aria-label="Default select example">
                <option selected>Select Medical Service</option>
                <option value="1">Medical Adult</option>
                <option value="2">Medical Pedia</option>
                <option value="3">Physical Therapy</option>
                <option value="4">Pre-Natal Check Up</option>
                <option value="5">Dental Extraction</option>
                <option value="6">Eye Screening</option>
                <option value="7">Pap Smear</option>
              </select>
            </div>
            <div class="d-flex flex-row mb-3">
              <h6>Contact Details and Address</h6>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Facebook</span>
              <input type="text" name="fbaccount" aria-label="Social" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Email</span>
              <input type="text" name="email" aria-label="Email" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Complete Address</span>
              <input type="text" name="address" aria-label="Address" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Contact Number</span>
              <input type="text" name="number" aria-label="Contact" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Area (Barangay/Subdivision)</span>
              <input type="text" name="area" aria-label="Area" class="form-control">
            </div>
          </form>
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>

<?php
        if (isset($_GET['ID'])) {
  $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
  $age = mysqli_real_escape_string($con, $_POST['age']);
  $gender = mysqli_real_escape_string($con, $_POST['gender']);
  $services = mysqli_real_escape_string($con, $_POST['services']);
  $fbaccount = mysqli_real_escape_string($con, $_POST['fbaccount']);
  $address = mysqli_real_escape_string($con, $_POST['address']);
  $area = mysqli_real_escape_string($con, $_POST['area']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $contact = mysqli_real_escape_string($con, $_POST['number']);
  $status = mysqli_real_escape_string($con, $_POST['status']);

   // Update the product details in the database
   $sqlUpdate = "UPDATE `patients` SET 
  firstName = '$firstName', 
  lastName = '$lastName', 
  age = '$age', 
  gender = '$gender', 
  services = '$services', 
  fbAccount = '$fbaccount', 
  address = '$address', 
  area = '$area', 
  email = '$email', 
  contact = '$contact', 
  status = '$status' 
  WHERE ID = '$ID'";
}
?>

         <!-- Edit Modal -->
         <div class="modal fade" id="editPatientModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
          <div class="f-flex flex-column">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Community Wellness Outreach Program</h1>
            <small>Update Patient</small>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
          <form method="POST" action="">
            <div class="d-flex flex-row mb-3">
              <h6>Update Medical Information</h6>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">First Name</span>
              <input type="text" name="firstName" value="<?= $row['firstName']; ?>" aria-label="First name" class="form-control">
              <span class="input-group-text">Last Name</span>
              <input type="text" name="lastName" value="<?= $row['lastName']; ?>" aria-label="Last name" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Age</span>
              <input type="text" name="age" value="<?= $row['age']; ?>" aria-label="Age" class="form-control">
            </div>
            <div class="d-flex flex-row mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
              <label class="form-check-label" for="flexRadioDefault1">
                Male
              </label>
            </div>
            <div class="form-check ms-3">
              <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
              <label class="form-check-label" for="flexRadioDefault2">
                Female
              </label>
            </div>
          </div>
            <div class="d-flex flex-row mb-3">
              <select class="form-select" name="services" aria-label="Default select example">
                <option selected value="<?= $row['services']; ?>"><?= $row['services']; ?>"</option>
                <option value="1">Medical Adult</option>
                <option value="2">Medical Pedia</option>
                <option value="3">Physical Therapy</option>
                <option value="4">Pre-Natal Check Up</option>
                <option value="5">Dental Extraction</option>
                <option value="6">Eye Screening</option>
                <option value="7">Pap Smear</option>
              </select>
            </div>
            <div class="d-flex flex-row mb-3">
              <h6>Contact Details and Address</h6>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Facebook</span>
              <input type="text" name="fbaccount" value="<?= $row['fbaccount']; ?>" aria-label="Social" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Email</span>
              <input type="text" name="email" value="<?= $row['email']; ?>" aria-label="Email" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Complete Address</span>
              <input type="text" name="address" value="<?= $row['address']; ?>" aria-label="Address" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Contact Number</span>
              <input type="text" name="number" value="<?= $row['number']; ?>" aria-label="Contact" class="form-control">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Area (Barangay/Subdivision)</span>
              <input type="text" name="area" value="<?= $row['area']; ?>" aria-label="Area" class="form-control">
            </div>
          </form>
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>

                </div>
            </div>
        </div>
    </main>
<!-- DataTables Buttons Extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


</body>
</html>