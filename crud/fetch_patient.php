<?php
require_once '../db/dbconn.php'; // Ensure the database connection is correct

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch the patient details
    $query = "SELECT * FROM patients WHERE ID = '$id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode(["status" => "success", "data" => $data]);
    } else {
        echo json_encode(["status" => "error", "message" => "Patient not found"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No ID provided"]);
}
?>
