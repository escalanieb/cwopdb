<?php
require_once '../db/dbconn.php'; // Ensure correct path

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize input
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $service = mysqli_real_escape_string($con, $_POST['service']);
    $partners = mysqli_real_escape_string($con, $_POST['partners']);
    $email= mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['number']);

    // Insert into database
    $sql = "INSERT INTO doctors (name, services, partners, email, number)
            VALUES ('$name', '$service', '$partners', '$email', '$number')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
}
?>
