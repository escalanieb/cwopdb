<?php
session_start();
require_once 'db/dbconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch the product details from the database
$sql = "SELECT * FROM patients";
$result = mysqli_query($con, $sql);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CWOP Patient Management System</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

  <style>
    #patientTable_wrapper {
      width: 100% !important;
    }
  </style>
</head>

<body>
  <main>
    <!-- Scripts (Proper Order) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


    <?php include 'sidebar.php'; ?>

    <div class="d-flex flex-column flex-fill p-5 bg-light" style="width: auto;">

      <div class="container-fluid mt-5">
        <h1>Patient Records</h1>
        <hr>
        <div class="justify-content-end mb-3">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModel">
            Add Patient
          </button>
        </div>
        <div class="table-responsive-sm">
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
                echo "<td>" . htmlspecialchars($row['ID'] ?? 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($row['firstName'] ?? 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($row['lastName'] ?? 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($row['age'] ?? 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($row['gender'] ?? 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($row['services'] ?? 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($row['status'] ?? 'N/A') . "</td>";
                echo '<td>
                           <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item editBtn" data-id="' . htmlspecialchars($row['ID'] ?? '0') . '" data-bs-toggle="modal" data-bs-target="#editPatientModel">Edit Patient</a></li>
                                <li><a class="dropdown-item editBtn" data-id="' . htmlspecialchars($row['ID'] ?? '0') . '" data-bs-toggle="modal" data-bs-target="#patientCompletion">Completion Form</a></li>
                                <li><a class="dropdown-item deleteBtn" data-id="' . htmlspecialchars($row['ID'] ?? '0') . '" style="color: Red; font-size: 15px; text-decoration: none;">Delete Patient</a></li>
                              </ul>
                            </div>
                    </td>';
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          console.log("Waiting for table to load...");

          setTimeout(function() {
            console.log("Initializing DataTable now...");
            $('#patientTable').DataTable({
              responsive: true,
              autoWidth: false,
              lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
              ],
              pageLength: 25, // Default to showing all rows
              language: {
                search: "Search Patients:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ patients"
              },
              order: [
                [0, "asc"]
              ],
              paging: true,
              searching: true,
              info: true,
              responsive: true
            });
            console.log("DataTable initialized successfully.");
          }, 1000); // 1-second delay to ensure table loads first
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
                <!-- Add Form -->
                <form id="addPatientForm" method="POST" action="crud/add_patient.php">

                  <div class="d-flex flex-row mb-3">
                    <h6>Medical Information Needed</h6>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">First Name</span>
                    <input type="text" name="firstName" aria-label="First name" class="form-control" required>
                    <span class="input-group-text">Last Name</span>
                    <input type="text" name="lastName" aria-label="Last name" class="form-control" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Age</span>
                    <input type="text" name="age" aria-label="Age" class="form-control" required>
                  </div>
                  <div class="d-flex flex-row mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" required>
                      <label class="form-check-label" for="flexRadioDefault1">Male</label>
                    </div>
                    <div class="form-check ms-3">
                      <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female" required>
                      <label class="form-check-label" for="flexRadioDefault2">Female</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row mb-3">
                    <select class="form-select" name="service" aria-label="Default select example" required>
                      <option selected disabled>Select Medical Service</option>
                      <option value="Medical Adult">Medical Adult</option>
                      <option value="Medical Pedia">Medical Pedia</option>
                      <option value="Physical Therapy">Physical Therapy</option>
                      <option value="Pre-Natal Check Up">Pre-Natal Check Up</option>
                      <option value="Dental Extraction">Dental Extraction</option>
                      <option value="Eye Screening">Eye Screening</option>
                      <option value="Pap Smear">Pap Smear</option>
                      <option value="Pap Smear">Dermatology</option>
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
                    <input type="email" name="email" aria-label="Email" class="form-control">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Complete Address</span>
                    <input type="text" name="address" aria-label="Address" class="form-control" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Contact Number</span>
                    <input type="text" name="number" aria-label="Contact" class="form-control" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Area (Barangay/Subdivision)</span>
                    <input type="text" name="area" aria-label="Area" class="form-control">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
                <!-- Success Message -->
                <div id="addSuccessMessage" class="alert alert-success mt-3" style="display: none;">
                  Patient added successfully!
                </div>
              </div>
            </div>
          </div>
        </div>

        <script>
          $(document).ready(function() {
            $("#addPatientForm").submit(function(e) {
              e.preventDefault(); // Prevent page reload

              $.ajax({
                type: "POST",
                url: "crud/add_patient.php",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                  if (response.status === "success") {
                    $("#addPatientForm")[0].reset(); // Clear the form
                    $("#addSuccessMessage").fadeIn(); // Show success message
                    setTimeout(function() {
                      $("#addSuccessMessage").fadeOut();
                      $("#addPatientModel").modal("hide"); // Close the modal
                      location.reload(); // Refresh the page to update the table
                    }, 1500);
                  } else {
                    alert("Error: " + response.message);
                  }
                }
              });
            });
          });
        </script>


        <!-- Fetch Patient Data for Editing -->
        <?php
        if (isset($_GET['id'])) {
          require_once 'db/dbconn.php'; // Ensure correct database connection

          $id = mysqli_real_escape_string($con, $_GET['id']); // Get the ID safely
          $query = "SELECT * FROM patients WHERE ID = '$id'";
          $result = mysqli_query($con, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
          } else {
            $row = []; // Set to an empty array if no data is found
          }
        } else {
          $row = []; // Set to an empty array if no ID is provided
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
                <!-- Update Form -->
                <form id="editPatientForm" method="POST" action="crud/update_patient.php">
                  <!-- Hidden Field to Store Patient ID -->
                  <input type="hidden" name="ID">

                  <div class="input-group mb-3">
                    <span class="input-group-text">First Name</span>
                    <input type="text" name="firstName" class="form-control">
                    <span class="input-group-text">Last Name</span>
                    <input type="text" name="lastName" class="form-control">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Age</span>
                    <input type="text" name="age" class="form-control">
                  </div>
                  <div class="d-flex flex-row mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="Male">
                      <label class="form-check-label" for="maleRadio">Male</label>
                    </div>
                    <div class="form-check ms-3">
                      <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="Female">
                      <label class="form-check-label" for="femaleRadio">Female</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row mb-3">
                    <select class="form-select" name="services">
                      <option value="">Select Medical Service</option>
                      <option value="Medical Adult">Medical Adult</option>
                      <option value="Medical Pedia">Medical Pedia</option>
                      <option value="Physical Therapy">Physical Therapy</option>
                      <option value="Pre-Natal Check Up">Pre-Natal Check Up</option>
                      <option value="Dental Extraction">Dental Extraction</option>
                      <option value="Eye Screening">Eye Screening</option>
                      <option value="Pap Smear">Pap Smear</option>
                      <option value="Dermatology">Dermatology</option>
                    </select>
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-group-text">Facebook</span>
                    <input type="text" name="fbaccount" class="form-control">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="text" name="email" class="form-control">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Address</span>
                    <input type="text" name="address" class="form-control">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Contact Number</span>
                    <input type="text" name="number" class="form-control">
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-group-text">Area (Barangay/Subdivision)</span>
                    <input type="text" name="area" class="form-control">
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- jQuery AJAX for Updating -->
        <script>
          $(document).ready(function() {
            $("#editPatientForm").submit(function(e) {
              e.preventDefault(); // Prevent page reload

              $.ajax({
                type: "POST",
                url: "crud/update_patient.php", // Ensure correct path
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                  console.log("Server Response:", response); // Debugging
                  if (response.status === "success") {
                    alert(response.message); // Display success message from server
                    location.reload(); // Refresh page to show updated data
                  } else {
                    alert("Error: " + response.message);
                  }
                },
                error: function(xhr, status, error) {
                  console.log("AJAX Error:", error); // Debugging
                  alert("Failed to update patient. Please check the console for details.");
                }
              });
            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $(".editBtn").click(function() {
              var patientId = $(this).data("id"); // Get patient ID from button

              $.ajax({
                type: "GET",
                url: "crud/fetch_patient.php?id=" + patientId, // Fetch patient details
                dataType: "json",
                success: function(response) {
                  if (response.status === "success") {
                    // Populate modal fields
                    $("input[name='ID']").val(response.data.ID);
                    $("input[name='firstName']").val(response.data.firstName);
                    $("input[name='lastName']").val(response.data.lastName);
                    $("input[name='age']").val(response.data.age);
                    $("input[name='email']").val(response.data.email);
                    $("input[name='address']").val(response.data.address);
                    $("input[name='number']").val(response.data.number);
                    $("input[name='fbaccount']").val(response.data.fbaccount);
                    $("input[name='area']").val(response.data.area);

                    // Set gender radio button
                    if (response.data.gender.toLowerCase() === "male") {
                      $("#editPatientModel input[name='gender'][value='Male']").prop("checked", true);
                    } else if (response.data.gender.toLowerCase() === "female") {
                      $("#editPatientModel input[name='gender'][value='Female']").prop("checked", true);
                    }

                    // Set service dropdown
                    $("select[name='services']").val(response.data.services);

                    console.log("Loaded data into modal:", response.data);
                  } else {
                    alert("Error: " + response.message);
                  }
                },
                error: function() {
                  alert("Failed to fetch patient details.");
                }
              });
            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $(".deleteBtn").click(function(e) {
              e.preventDefault(); // Prevent default link behavior
              var patientId = $(this).data("id");

              if (confirm("Are you sure you want to delete this patient?")) {
                $.ajax({
                  type: "POST",
                  url: "crud/delete_patient.php", // Ensure correct path
                  data: {
                    id: patientId
                  },
                  dataType: "json",
                  success: function(response) {
                    console.log("Server Response:", response); // Debugging

                    if (response.status === "success") {
                      alert(response.message);
                      location.reload(); // Refresh page to update the list
                    } else {
                      alert("Error: " + response.message);
                    }
                  },
                  error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                    alert("Failed to delete patient. Please check the console for details.");
                  }
                });
              }
            });
          });
        </script>

        <!-- Patient Completion Form Upon Check Out -->
        <div class="modal fade" id="patientCompletion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="f-flex flex-column">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Community Wellness Outreach Program</h1>
                  <small>Completion Form</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Add Form -->
                <form id="patientCompletionForm" method="POST" action="crud/add_diagnostics.php">
                  <div id="patientUpdateSuccess" class="alert alert-success mt-3" style="display: none;">
                    Patient Completed Successfully!
                  </div>
                  <!-- Hidden Field to Store Patient ID -->
                  <input type="hidden" name="ID">
                  <input type="hidden" name="patient_status" value="Done">
                  <h6>Nurse's Station</h6>
                  <hr>
                  <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">BP</b></span>
                    <input type="text" name="patient_bp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <span class="input-group-text" id="inputGroup-sizing-sm">PR</span>
                    <input type="text" name="patient_pr" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <span class="input-group-text" id="inputGroup-sizing-sm">RR</span>
                    <input type="text" name="patient_rr" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Temperature</span>
                    <input type="text" name="patient_temp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Weight</span>
                    <input type="text" name="patient_weight" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Height</span>
                    <input type="text" name="patient_height" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>

                  <h6 class="mt-3">Diagnostic Section</h6>
                  <hr>
                  <div class="d-flex flex-row justify-content-around">
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_cbc" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">CBC</label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_blood" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Blood Typing</label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_urine" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Urinalysis</label>
                    </div>
                  </div>
                  <h6 class="mt-3">Doctor's/Dentist's/Optometrist's Comment</h6>
                  <hr>
                  <div class="form-floating">
                    <textarea class="form-control" name="patient_diagnosis" placeholder="Diagnosis" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Diagnosis of Doctor</label>
                  </div>
                  <div class="form-floating mt-2">
                    <textarea class="form-control" name="patient_reco" placeholder="Recommendations" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Doctor Recommendations</label>
                  </div>
                  <h6 class="mt-3">Counsellor's Section</h6>
                  <hr>
                  <div class="d-flex flex-row justify-content-around">
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_save" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Salvation</label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_ass" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Assurance</label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_prayer" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Prayer</label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="patient_bap" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Baptism</label>
                    </div>
                  </div>
                  <div class="input-group input-group-sm my-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Counselor Name</b></span>
                    <input type="text" name="counsel_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Checkout Patient</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <script>
          $(document).ready(function() {
            $("#patientCompletionForm").submit(function(e) {
              e.preventDefault(); // Prevent page reload

              $.ajax({
                type: "POST",
                url: "crud/add_diagnostics.php",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                  if (response.status === "success") {
                    $("#patientCompletionForm")[0].reset(); // Clear the form
                    $("#patientUpdateSuccess").fadeIn(); // Show success message
                    setTimeout(function() {
                      $("#patientUpdateSuccess").fadeOut();
                      $("#patientCompletionForm").modal("hide"); // Close the modal
                      location.reload(); // Refresh the page to update the table
                    }, 1500);
                  } else {
                    alert("Error: " + response.message);
                  }
                }
              });
            });
          });
        </script>

      </div>
    </div>
    </div>
  </main>

</body>

</html>