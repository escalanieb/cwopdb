<!-- Sidebar Toggle Button -->
<button class="navbar-toggler position-fixed m-3 btn btn-primary" style="z-index: 1050;" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" id="menuToggle">
  <span class="navbar-toggler-icon">☰</span>
</button>


<!-- Offcanvas Sidebar for Small Screens -->
<div class="offcanvas offcanvas-start text-bg-dark d-block" style="width: 280px; height: 100vh;" id="sidebarMenu" tabindex="-1" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarMenuLabel">CWOP System</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" style="width: 280px; height: 100vh;">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="index.php" class="nav-link text-white">Dashboard</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Patient Management</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="patients.php">View All Patients</a></li>
          <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addPatientModel">Add Patient</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Staff Management</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="all.php">View All Personnels</a></li>
          <li><a class="dropdown-item" href="doctors.php">View Doctors</a></li>
          <li><a class="dropdown-item" href="partners.php">View Partners</a></li>
          <li><a class="dropdown-item" href="nonstaff.php">View Non-Ministry Personnels</a></li>
          <li><a class="dropdown-item" href="staff.php">View Ministry Personnels</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<!-- JavaScript to handle active link highlighting and toggle button visibility -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    let links = document.querySelectorAll(".nav-link");
    let currentPath = window.location.pathname.split("/").pop();

    links.forEach(link => {
      let linkPath = link.getAttribute("href").split("/").pop();
      if (linkPath === currentPath) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });

    // Handle toggle button visibility when the sidebar is shown/hidden
    let menuToggle = document.getElementById("menuToggle");
    let sidebarMenu = document.getElementById("sidebarMenu");

    sidebarMenu.addEventListener("shown.bs.offcanvas", function () {
      menuToggle.style.display = "none"; // Hide toggle button when sidebar opens
    });

    sidebarMenu.addEventListener("hidden.bs.offcanvas", function () {
      menuToggle.style.display = "block"; // Show toggle button when sidebar closes
    });
  });
</script>
