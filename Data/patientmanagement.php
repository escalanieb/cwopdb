<?php
session_start();
require_once './data/dbconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch all data from the "patients" table
$sql = "SELECT * FROM `patients` ORDER BY ID";
$result = mysqli_query($con, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CWOP Patient Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

<body>
    <script src="https://cd</div>n.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>   
    <h1>Patient Data</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Services</th>
            <th>Facebook Account</th>
            <th>Address</th>
            <th>Area</th>
            <th>E-mail</th>
            <th>Number</th>
            <th>Date and Time</th>
        </tr>
        <?php
        // Loop through each row of the result and display the data in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . ($row['gender'] == 0 ? 'Male' : 'Female') . "</td>";
            echo "<td>" . $row['services'] . "</td>";
            echo "<td>" . $row['fbaccount'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['area'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['number'] . "</td>";
            echo "<td>" . $row['datetime'] . "</td>";
            echo "<td><a href='edituser.php?id=" . $row['ID'] . "' style='color: Blue; font-size: 15px; text-decoration: none; background-color: none;'>Edit</a></td>";
            echo "<td><a href='deleteuser.php?id=" . $row['ID'] . "' style='color: Red; font-size: 15px; text-decoration: none; background-color: none;'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
