<?php
require_once '../db/dbconn.php';

// Enable error reporting to catch issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($con, $_POST['ID']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $service = mysqli_real_escape_string($con, $_POST['service']);
    $partners = mysqli_real_escape_string($con, $_POST['partners']);
    $email= mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['number']);

    $sqlUpdate = "UPDATE doctors SET
                    name = '$name',
                    services = '$service',
                    partners = '$partners',
                    email = '$email',
                    number = '$number'
                  WHERE ID = '$id'";

    if (mysqli_query($con, $sqlUpdate)) {
        echo json_encode(["status" => "success", "message" => "Doctor updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($con)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
