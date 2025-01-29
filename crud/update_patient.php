<?php
require_once '../db/dbconn.php';

// Enable error reporting to catch issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($con, $_POST['ID']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']); 
    $services = mysqli_real_escape_string($con, $_POST['services']);
    $fbaccount = mysqli_real_escape_string($con, $_POST['fbaccount']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $area = mysqli_real_escape_string($con, $_POST['area']); 
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['number']);

    $sqlUpdate = "UPDATE patients SET 
                    firstName = '$firstName',
                    lastName = '$lastName',
                    age = '$age',
                    gender = '$gender', 
                    services = '$services',
                    fbaccount = '$fbaccount',
                    address = '$address',
                    area = '$area', 
                    email = '$email',
                    number = '$contact'
                  WHERE ID = '$id'";

    if (mysqli_query($con, $sqlUpdate)) {
        echo json_encode(["status" => "success", "message" => "Patient updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($con)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
