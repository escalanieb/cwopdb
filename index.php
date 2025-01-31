<?php
session_start();
require_once 'db/dbconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CWOP Patient Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="d-flex flex-row">
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark fixed-top" style="width: 280px; height: 100%;">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <span class="fs-4" width="40">CWOP System</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
              Dashboard
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              <li><a class="dropdown-item text-dark" href="all.php">View All Personnels</a></li>
              <li><a class="dropdown-item text-dark" href="doctors.php">View Doctors</a></li>
              <li><a class="dropdown-item text-dark" href="partners.php">View Partners</a></li>
              <li><a class="dropdown-item text-dark" href="nonstaff.php">View Non-Ministry Personnels</a></li>
              <li><a class="dropdown-item text-dark" href="staff.php">View Ministry Personnels</a></li>
            </ul>
          </li>
      </div>

      <div class="d-flex flex-column flex-fill p-5 bg-light" style="width: auto; margin-left: 15%;">
        <div class="container-fluid">
          <h5>General Results</h5>
          <hr>
          <div class="d-flex flex-row flex-fill justify-content-start">
            <div class="card me-3" style="width: 25rem;">
              <div class="card-body">
                <span class="badge text-bg-primary">Overall Number of Patients</span>
                <h1 class="card-title" id="totalPatients">Loading...</h1>
              </div>
            </div>
            <div class="card me-3" style="width: 25rem;">
              <div class="card-body">
                <span class="badge text-bg-warning">Number of Patients - On-Going</span>
                <h1 class="card-title" id="totalPatientsOnGoing">Loading...</h1>
              </div>
            </div>
            <div class="card me-3" style="width: 25rem;">
              <div class="card-body">
                <span class="badge text-bg-success">Number of Patients - Done</span>
                <h1 class="card-title" id="totalPatientsDone">Loading...</h1>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex flex-row flex-fill align-items-start mt-5">
          <div class="container-fluid">
            <h5>Detailed Results</h5>
            <hr>
            <div class="d-flex flex-row flex-fill justify-content-start">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Services</th>
                    <th scope="col">Number of Patients</th>
                    <th scope="col">Limit Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Medical - Adult</td>
                    <td id="totalPatientsAdult">Loading...</td>
                    <td><button type="button" class="btn btn-success">Loading...</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsAdult = parseInt($("#totalPatientsAdult").text());
                          if (totalPatientsAdult >= 500) {
                            $("#totalPatientsAdult").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsAdult").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Medical - Pedia</td>
                    <td id="totalPatientsPedia">Loading...</td>
                    <td><button type="button" class="btn btn-success">Open</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsPedia = parseInt($("#totalPatientsPedia").text());
                          if (totalPatientsPedia >= 500) {
                            $("#totalPatientsPedia").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsPedia").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Physical Therapy</td>
                    <td id="totalPatientsPT">Loading...</td>
                    <td><button type="button" class="btn btn-warning">Almost Limit</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsPT = parseInt($("#totalPatientsPT").text());
                          if (totalPatientsPT >= 100) {
                            $("#totalPatientsPT").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsPT").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Pre-Natal Check Up</td>
                    <td id="totalPatientsPN">Loading...</td>
                    <td><button type="button" class="btn btn-success">At Limit</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsPN = parseInt($("#totalPatientsPN").text());
                          if (totalPatientsPN >= 100) {
                            $("#totalPatientsPN").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsPN").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Dental Extraction</td>
                    <td id="totalPatientsDental">Loading...</td>
                    <td><button type="button" class="btn btn-success">Open</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsDental = parseInt($("#totalPatientsDental").text());
                          if (totalPatientsDental >= 250) {
                            $("#totalPatientsDental").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsDental").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>Eye Screening</td>
                    <td id="totalPatientsES">Loading...</td>
                    <td><button type="button" class="btn btn-success">Open</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsES = parseInt($("#totalPatientsES").text());
                          if (totalPatientsES >= 150) {
                            $("#totalPatientsES").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsES").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>Dermatology</td>
                    <td id="totalPatientsDerm">Loading...</td>
                    <td><button type="button" class="btn btn-success">Open</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsDerm = parseInt($("#totalPatientsDerm").text());
                          if (totalPatientsDerm >= 150) {
                            $("#totalPatientsDerm").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsDerm").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                  <tr>
                    <th scope="row">8</th>
                    <td>Pap-Smear</td>
                    <td id="totalPatientsPS">Loading...</td>
                    <td><button type="button" class="btn btn-success">Open</button></td>
                    <script>
                      $(document).ready(function() {
                        function updateButtonStatus() {
                          var totalPatientsPS = parseInt($("#totalPatientsPS").text());
                          if (totalPatientsPS >= 75) {
                            $("#totalPatientsPS").closest('tr').find('button').removeClass('btn-success').addClass('btn-danger').text('At Limit');
                          } else {
                            $("#totalPatientsPS").closest('tr').find('button').removeClass('btn-warning').addClass('btn-success').text('Open');
                          }
                        }

                        // Call the function initially
                        updateButtonStatus();

                        // Call the function after fetching counts
                        $(document).ajaxComplete(function() {
                          updateButtonStatus();
                        });
                      });
                    </script>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="container-fluid">
            <div class="d-flex flex-column flex-fill justify-content-start">
              <h5>Counselling Results</h5>
              <hr>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Discussion</th>
                    <th scope="col">Number Counselled</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Salvation</td>
                    <td id="totalPatientsSaved">Loading...</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Assurance</td>
                    <td id="totalPatientsAssurance">Loading...</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Prayer for Health</td>
                    <td id="totalPatientsPrayer">Loading...</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Baptism</td>
                    <td id="totalPatientsBaptism">Loading...</td>
                  </tr>
                </tbody>
              </table>

              <div class="container-fluid">

              </div>
            </div>
          </div>
        </div>


        <!--Getting Counts-->
        <script>
          $(document).ready(function() {
            // Function to fetch counts from PHP
            function fetchCounts() {
              $.ajax({
                url: 'crud/fetch_patient_count.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                  $("#totalPatients").text(response.total_patients);
                  $("#totalPatientsOnGoing").text(response.total_patients_ongoing);
                  $("#totalPatientsDone").text(response.total_patients_done);
                  $("#totalPatientsAdult").text(response.total_patients_adult);
                  $("#totalPatientsPedia").text(response.total_patients_pedia);
                  $("#totalPatientsPT").text(response.total_patients_PT);
                  $("#totalPatientsPN").text(response.total_patients_PN);
                  $("#totalPatientsDental").text(response.total_patients_dental);
                  $("#totalPatientsES").text(response.total_patients_ES);
                  $("#totalPatientsDerm").text(response.total_patients_DERM);
                  $("#totalPatientsPS").text(response.total_patients_PS);
                  $("#totalPatientsSaved").text(response.total_patients_saved);
                  $("#totalPatientsBaptism").text(response.total_patients_baptism);
                  $("#totalPatientsPrayer").text(response.total_patients_pray);
                  $("#totalPatientsAssurance").text(response.total_patients_assured);
                },
                error: function() {
                  $("#totalPatients").text("Error loading counts.");
                  $("#totalPatientsOnGoing").text("Error loading counts.");
                  $("#totalPatientsDone").text("Error loading counts.");
                  $("#totalPatientsAdult").text("Error loading counts.");
                  $("#totalPatientsPedia").text("Error loading counts.");
                  $("#totalPatientsPT").text("Error loading counts.");
                  $("#totalPatientsPN").text("Error loading counts.");
                  $("#totalPatientsDental").text("Error loading counts.");
                  $("#totalPatientsES").text("Error loading counts.");
                  $("#totalPatientsDerm").text("Error loading counts.");
                  $("#totalPatientsPS").text("Error loading counts.");
                  $("#totalPatientsSaved").text("Error loading counts.");
                  $("#totalPatientsBaptism").text("Error loading counts.");
                  $("#totalPatientsPrayer").text("Error loading counts.");
                  $("#totalPatientsAssurance").text("Error loading counts.");
                }
              });
            }

            // Load counts initially
            fetchCounts();

            // Auto-refresh every 5 seconds
            setInterval(fetchCounts, 5000);
          });
        </script>


        <div class="container-fluid mt-5">
          <!-- Modal -->
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
                  <form>
                    <div class="d-flex flex-row mb-3">
                      <h6>Medical Information Needed</h6>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">First Name</span>
                      <input type="text" aria-label="First name" class="form-control">
                      <span class="input-group-text">Last Name</span>
                      <input type="text" aria-label="Last name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Age</span>
                      <input type="text" aria-label="Age" class="form-control">
                    </div>
                    <div class="d-flex flex-row mb-3">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Male
                        </label>
                      </div>
                      <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Female
                        </label>
                      </div>
                    </div>
                    <div class="d-flex flex-row mb-3">
                      <select class="form-select" aria-label="Default select example">
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
                      <input type="text" aria-label="First name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Email</span>
                      <input type="text" aria-label="Last name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Complete Address</span>
                      <input type="text" aria-label="Last name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Contact Number</span>
                      <input type="text" aria-label="Last name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Area (Barangay/Subdivision)</span>
                      <input type="text" aria-label="Last name" class="form-control">
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
</body>

</html>