<?php
require_once 'db/dbconn.php'; // Ensure correct path

$sql = "SELECT COUNT(*) AS total FROM patients";
$result = mysqli_query($con, $sql);
$patients = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) AS total FROM doctors";
$result = mysqli_query($con, $sql);
$doctors = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) AS total FROM partners";
$result = mysqli_query($con, $sql);
$partners = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) AS total FROM nonstaff";
$result = mysqli_query($con, $sql);
$nonstaff = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) AS total FROM staff";
$result = mysqli_query($con, $sql);
$staff = mysqli_fetch_assoc($result);

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
                            <h1 class="card-title"><?php echo $patients["total"]; ?></h1>
                          </div>
                        </div>
                        <div class="card me-3" style="width: 25rem;">
                          <div class="card-body">
                              <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Doctors</h6>
                              <h1 class="card-title"><?php echo $doctors["total"]; ?></h1>
                          </div>
                        </div>
                        <div class="card me-3" style="width: 25rem;">
                          <div class="card-body">
                              <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Partners</h6>
                              <h1 class="card-title"><?php echo $partners["total"]; ?></h1>
                          </div>
                        </div>
                        <div class="card me-3" style="width: 25rem;">
                          <div class="card-body">
                              <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Non-ministry Personnels</h6>
                              <h1 class="card-title"><?php echo $nonstaff["total"]; ?></h1>
                          </div>
                        </div>
                        <div class="card me-3" style="width: 25rem;">
                          <div class="card-body">
                              <h6 class="card-subtitle text-body-secondary mb-2">Total Number of Ministry Personnels</h6>
                              <h1 class="card-title"><?php echo $staff["total"]; ?></h1>
                          </div>
                        </div>
                  </div>
              </div>

              <div class="container-fluid mt-5">
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
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Medical - Adult</td>
                              <td>1,300</td>
                              <td><button type="button" class="btn btn-success">Open</button></td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td>Medical - Pedia</td>
                              <td>500</td>
                              <td><button type="button" class="btn btn-success">Open</button></td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td>Physical Therapy</td>
                              <td>120</td>
                              <td><button type="button" class="btn btn-warning">Almost Limit</button></td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">4</th>
                              <td>Pre-Natal Check Up</td>
                              <td>245</td>
                              <td><button type="button" class="btn btn-danger">At Limit</button></td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">5</th>
                              <td>Dental Extraction</td>
                              <td>400</td>
                              <td><button type="button" class="btn btn-success">Open</button></td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">5</th>
                              <td>Eye Screening</td>
                              <td>324</td>
                              <td><button type="button" class="btn btn-success">Open</button></td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
              </div>

              <div class="container-fluid mt-5">
                  <h5>Counselling Results</h5>
                  <hr>
                  <div class="d-flex flex-row flex-fill justify-content-start">
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Services</th>
                              <th scope="col">Number of Patients</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Salvation</td>
                              <td>1,300</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td>Medical - Pedia</td>
                              <td>500</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td>Physical Therapy</td>
                              <td>120</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">View Patients</a></li>
                                        <li><a class="dropdown-item" href="#">Add Patients</a></li>
                                      </ul>
                                    </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
              </div>

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