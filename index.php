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

    <?php include 'sidebar.php'; ?>

    <div class="container-fluid p-5 bg-light">
      <h5>General Results</h5>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <span class="badge text-bg-primary">Overall Number of Patients</span>
              <h1 class="card-title" id="totalPatients">Loading...</h1>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <span class="badge text-bg-warning">Number of Patients - On-Going</span>
              <h1 class="card-title" id="totalPatientsOnGoing">Loading...</h1>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <span class="badge text-bg-success">Number of Patients - Done</span>
              <h1 class="card-title" id="totalPatientsDone">Loading...</h1>
            </div>
          </div>
        </div>
      </div>

      <h5 class="mt-5">Detailed Results</h5>
      <hr>
      <div class="table-responsive">
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
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Medical - Pedia</td>
              <td id="totalPatientsPedia">Loading...</td>
              <td><button type="button" class="btn btn-success">Open</button></td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Physical Therapy</td>
              <td id="totalPatientsPT">Loading...</td>
              <td><button type="button" class="btn btn-success">Almost Limit</button></td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Pre-Natal Check Up</td>
              <td id="totalPatientsPN">Loading...</td>
              <td><button type="button" class="btn btn-success">At Limit</button></td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Dental Extraction</td>
              <td id="totalPatientsDental">Loading...</td>
              <td><button type="button" class="btn btn-success">Open</button></td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>Eye Screening</td>
              <td id="totalPatientsES">Loading...</td>
              <td><button type="button" class="btn btn-success">Open</button></td>
            </tr>
            <tr>
              <th scope="row">7</th>
              <td>Dermatology</td>
              <td id="totalPatientsDerm">Loading...</td>
              <td><button type="button" class="btn btn-success">Open</button></td>
            </tr>
            <tr>
              <th scope="row">8</th>
              <td>Pap-Smear</td>
              <td id="totalPatientsPS">Loading...</td>
              <td><button type="button" class="btn btn-success">Open</button></td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5 class="mt-5">Counselling Results</h5>
      <hr>
      <div class="table-responsive">
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
      </div>

      <!-- Getting Counts -->
      <script>
        $(document).ready(function() {
          function updateButtonStatus() {
            // Update button status for each service
            const services = [{
                id: "totalPatientsAdult",
                limit: 500
              },
              {
                id: "totalPatientsPedia",
                limit: 500
              },
              {
                id: "totalPatientsPT",
                limit: 100
              },
              {
                id: "totalPatientsPN",
                limit: 100
              },
              {
                id: "totalPatientsDental",
                limit: 250
              },
              {
                id: "totalPatientsES",
                limit: 150
              },
              {
                id: "totalPatientsDerm",
                limit: 150
              },
              {
                id: "totalPatientsPS",
                limit: 75
              }
            ];

            services.forEach(service => {
              const totalPatients = parseInt($(`#${service.id}`).text()) || 0; // Ensure valid number
              const button = $(`#${service.id}`).closest('tr').find('button');

              if (totalPatients >= service.limit) {
                button.removeClass('btn-success btn-warning').addClass('btn-danger').text('At Limit');
              } else {
                button.removeClass('btn-danger').addClass('btn-success').text('Open');
              }
            });
          }

          function fetchPatientData() {
            $.ajax({
              url: "crud/fetch_patient_count.php", // Adjust this path if needed
              type: "GET",
              dataType: "json",
              success: function(data) {
                if (data.error) {
                  console.error("Error:", data.error);
                  return;
                }

                // Populate HTML elements with fetched data
                $("#totalPatients").text(data.total_patients);
                $("#totalPatientsOnGoing").text(data.total_patients_ongoing);
                $("#totalPatientsDone").text(data.total_patients_done);
                $("#totalPatientsAdult").text(data.total_patients_adult);
                $("#totalPatientsPedia").text(data.total_patients_pedia);
                $("#totalPatientsPT").text(data.total_patients_PT);
                $("#totalPatientsPN").text(data.total_patients_PN);
                $("#totalPatientsDental").text(data.total_patients_dental);
                $("#totalPatientsES").text(data.total_patients_ES);
                $("#totalPatientsDerm").text(data.total_patients_DERM);
                $("#totalPatientsPS").text(data.total_patients_PS);
                $("#totalPatientsSaved").text(data.total_patients_saved);
                $("#totalPatientsBaptism").text(data.total_patients_baptism);
                $("#totalPatientsPrayer").text(data.total_patients_pray);
                $("#totalPatientsAssurance").text(data.total_patients_assured);

                // Call updateButtonStatus after updating the numbers
                updateButtonStatus();
              },
              error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
              }
            });
          }

          // Fetch data when the page loads
          fetchPatientData();

          // Auto-refresh every 5 seconds for live updates
          setInterval(fetchPatientData, 5000);
        });
      </script>

      <!-- Modal -->
      <div class="modal fade" id="addPatientModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Community Wellness Outreach Program</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
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
                <div class="mb-3">
                  <h6>Gender</h6>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="genderMale">
                    <label class="form-check-label" for="genderMale">Male</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="genderFemale">
                    <label class="form-check-label" for="genderFemale">Female</label>
                  </div>
                </div>
                <div class="mb-3">
                  <select class="form-select" aria-label="Select Medical Service">
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
                <div class="mb-3">
                  <h6>Contact Details and Address</h6>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Facebook</span>
                  <input type="text" aria-label="Facebook" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Email</span>
                  <input type="text" aria-label="Email" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Complete Address</span>
                  <input type="text" aria-label="Address" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Contact Number</span>
                  <input type="text" aria-label="Contact Number" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Area (Barangay/Subdivision)</span>
                  <input type="text" aria-label="Area" class="form-control">
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
  </main>
</body>

</html>