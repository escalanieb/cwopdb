<?php
require_once '../db/dbconn.php'; // Ensure correct path

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize input
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $service = mysqli_real_escape_string($con, $_POST['service']);
    $fbaccount = mysqli_real_escape_string($con, $_POST['fbaccount']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $area = mysqli_real_escape_string($con, $_POST['area']);
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $datetime = date("Y-m-d H:i:s"); // Capture current timestamp
    $status = 1; // Default status (1 = Active, 0 = Inactive)

    // Insert into database
    $sql = "INSERT INTO patients (firstName, lastName, age, gender, services, fbaccount, address, area, email, number, datetime, status)
            VALUES ('$firstName', '$lastName', '$age', '$gender', '$service', '$fbaccount', '$address', '$area', '$email', '$number', '$datetime', '$status')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
}
