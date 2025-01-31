<?php
session_start();
require_once 'db/dbconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  // Fetch the product details from the database
  $sql = "SELECT * FROM staff";
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
    #staffTable_wrapper {
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


        <div class="d-flex flex-row">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark fixed-top" style="width: 280px; height: 100%;">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4" width="40">CWOP System</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white" aria-current="page">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Patient Management
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" style="width: 100%;">
                          <li><a class="dropdown-item text-dark" href="patients.php">View All Patients</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Staff Management
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" style="width: 100%;">
                            <li><a class="dropdown-item text-dark" href="all.php">View All Personnels</a></li>
                            <li><a class="dropdown-item text-dark" href="staffs.php">View Doctors</a></li>
                            <li><a class="dropdown-item text-dark" href="partners.php">View Partners</a></li>
                            <li><a class="dropdown-item text-dark" href="nonstaff.php">View Non-Ministry Personnels</a></li>
                            <li><a class="dropdown-item text-dark" href="staff.php">View Ministry Personnels</a></li>
                        </ul>
                    </li>
            </div>
    
            <div class="d-flex flex-column flex-fill p-5 bg-light" style="width: auto; margin-left: 15%;">
                
                <div class="container-fluid mt-5">
                <h1>Ministry Personnels</h1>
                <hr>
                <div class="justify-content-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModel">
                    Add Ministry Personnels
                </button>
                </div>
    <div class="d-flex flex-row justify-content-center">
        <table class="table table-hover w-100" id="staffTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Number</th>
                    <th scope="col">Membership Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each row of the result and display the data in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ID'] ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($row['name'] ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($row['department'] ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($row['email'] ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($row['number'] ?? 'N/A') . "</td>";
                    echo "<td>" . htmlspecialchars($row['membership_status'] ?? 'N/A') . "</td>";
                    echo '<td>
                        <a href="#" class="editBtn" data-id="' . htmlspecialchars($row['ID'] ?? '0') . '" 
                           data-bs-toggle="modal" data-bs-target="#editStaffModel" 
                           style="color: Blue; font-size: 15px; text-decoration: none;">Edit</a>  
                        <a href="#" class="deleteBtn" data-id="' . htmlspecialchars($row['ID'] ?? '0') . '" 
                           style="color: Red; font-size: 15px; text-decoration: none;">Delete</a>
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
        $('#staffTable').DataTable({
            responsive: true,
            autoWidth: false,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            pageLength: 25, // Default to showing all rows
            language: {
                search: "Search Staffs:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ staffs"
            },
            order: [[0, "asc"]], 
            paging: true,
            searching: true,
            info: true
        });
        console.log("DataTable initialized successfully.");
    }, 1000); // 1-second delay to ensure table loads first
});
</script>




        <div class="container-fluid mt-5">

       <!-- Add Modal -->
<div class="modal fade" id="addStaffModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="f-flex flex-column">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Community Wellness Outreach Program</h1>
          <small>Add Non-ministry Personnels</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add Form -->
        <form id="addStaffForm" method="POST" action="crud/add_staff.php">

          <div class="d-flex flex-row mb-3">
          <h6>Information Needed</h6>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Name</span>
            <input type="text" name="name" aria-label="First name" class="form-control" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Department</span>
            <input type="text" name="department" aria-label="First name" class="form-control" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="email" name="email" aria-label="Email" class="form-control">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Contact Number</span>
            <input type="text" name="number" aria-label="Contact" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        <!-- Success Message -->
        <div id="addSuccessMessage" class="alert alert-success mt-3" style="display: none;">
          Non-staff added successfully!
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#addStaffForm").submit(function(e) {
      e.preventDefault(); // Prevent page reload

      $.ajax({
        type: "POST",
        url: "crud/add_staff.php",
        data: $(this).serialize(),
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            $("#addStaffForm")[0].reset(); // Clear the form
            $("#addSuccessMessage").fadeIn(); // Show success message
            setTimeout(function() {
              $("#addSuccessMessage").fadeOut();
              $("#addStaffModel").modal("hide"); // Close the modal
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


<!-- Fetch staff Data for Editing -->
<?php
if (isset($_GET['id'])) {
    require_once 'db/dbconn.php'; // Ensure correct database connection

    $id = mysqli_real_escape_string($con, $_GET['id']); // Get the ID safely
    $query = "SELECT * FROM staff WHERE ID = '$id'";
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
<div class="modal fade" id="editStaffModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="f-flex flex-column">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Community Wellness Outreach Program</h1>
          <small>Update Staff</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Update Form -->
        <form id="editStaffForm" method="POST" action="crud/edit_staff.php">
        <input type="hidden" name="ID">

        <div class="d-flex flex-row mb-3">
          <h6>Information Needed</h6>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Name</span>
            <input type="text" name="name" aria-label="First name" class="form-control" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Department</span>
            <input type="text" name="department" aria-label="First name" class="form-control" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="email" name="email" aria-label="Email" class="form-control">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Contact Number</span>
            <input type="text" name="number" aria-label="Contact" class="form-control" required>
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
    $("#editStaffForm").submit(function(e) {
        e.preventDefault(); // Prevent page reload

        $.ajax({
            type: "POST",
            url: "crud/update_staff.php", // Ensure correct path
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
                alert("Failed to update staff. Please check the console for details.");
            }
        });
    });
});

</script>

<script>
$(document).ready(function() {
    $(".editBtn").click(function() {
        var staffId = $(this).data("id"); // Get staff ID from button

        $.ajax({
            type: "GET",
            url: "crud/fetch_staff.php?id=" + staffId, // Fetch staff details
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    // Populate modal fields
                    $("input[name='ID']").val(response.data.ID);
                    $("input[name='name']").val(response.data.name);
                    $("input[name='department']").val(response.data.department);
                    $("input[name='email']").val(response.data.email);
                    $("input[name='number']").val(response.data.number);
                  

                    console.log("Loaded data into modal:", response.data);
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function() {
                alert("Failed to fetch staff details.");
            }
        });
    });
});
</script>

<script>
  $(document).ready(function() {
    $(".deleteBtn").click(function(e) {
        e.preventDefault(); // Prevent default link behavior
        var staffId = $(this).data("id");

        if (confirm("Are you sure you want to delete this staff?")) {
            $.ajax({
                type: "POST",
                url: "crud/delete_staff.php", // Ensure correct path
                data: { id: staffId },
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
                    alert("Failed to delete staff. Please check the console for details.");
                }
            });
        }
    });
});

</script>
                </div>
            </div>
        </div>
    </main>

</body>
</html>