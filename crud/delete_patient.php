<?php
require_once '../db/dbconn.php'; // Database connection

header('Content-Type: application/json'); // Return JSON response

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);

        // Delete patient record
        $query = "DELETE FROM patients WHERE ID = '$id'";
        if (mysqli_query($con, $query)) {
            echo json_encode(["status" => "success", "message" => "Patient deleted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($con)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing patient ID"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
