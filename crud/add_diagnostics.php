<?php
require_once '../db/dbconn.php'; // Ensure correct path

// Enable error reporting (For debugging, remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize input
    // Diagnostics
    $patient_id = mysqli_real_escape_string($con, $_POST['ID'] ?? '');
    $cbc = mysqli_real_escape_string($con, $_POST['patient_cbc'] ?? '');
    $blood_typing = mysqli_real_escape_string($con, $_POST['patient_blood'] ?? '');
    $urinalysis = mysqli_real_escape_string($con, $_POST['patient_urine'] ?? '');
    $diagnosis = mysqli_real_escape_string($con, $_POST['patient_diagnosis'] ?? '');
    $recommendation = mysqli_real_escape_string($con, $_POST['patient_reco'] ?? '');

    // Vitals
    $bp = mysqli_real_escape_string($con, $_POST['patient_bp'] ?? '');
    $rr = mysqli_real_escape_string($con, $_POST['patient_rr'] ?? '');
    $temp = mysqli_real_escape_string($con, $_POST['patient_temp'] ?? '');
    $weight = mysqli_real_escape_string($con, $_POST['patient_weight'] ?? '');
    $height = mysqli_real_escape_string($con, $_POST['patient_height'] ?? '');

    // Counselor
    $counselor_name = mysqli_real_escape_string($con, $_POST['counsel_name'] ?? '');
    $salvation_status = mysqli_real_escape_string($con, $_POST['patient_save'] ?? '');
    $baptism_status = mysqli_real_escape_string($con, $_POST['patient_bap'] ?? '');
    $prayer_status = mysqli_real_escape_string($con, $_POST['patient_prayer'] ?? '');
    $assurance_stats = mysqli_real_escape_string($con, $_POST['patient_ass'] ?? '');

    // Update Status of Patient
    $patient_status = mysqli_real_escape_string($con, $_POST['patient_status'] ?? '');

    // Insert into database
    $sqlVitals = "INSERT INTO patient_vitals_record (patient_id, bp, rr, temp, weight, height)
            VALUES ('$patient_id', '$bp', '$rr', '$temp', '$weight', '$height')";

    $sqlDiag = "INSERT INTO patient_diagnostics_record (patient_id, cbc, blood_typing, urinalysis, diagnosis, recommendations)
            VALUES ('$patient_id', '$cbc', '$blood_typing', '$urinalysis', '$diagnosis', '$recommendation')";

    $sqlCounsel = "INSERT INTO counselor_records (patient_id, counselor_name, salvation_status, baptism_status, prayer_status, assurance_status)
            VALUES ('$patient_id', '$counselor_name', '$salvation_status', '$baptism_status', '$prayer_status', '$assurance_stats')";

    $sqlUpdate = "UPDATE patients SET
                    status = '$patient_status'
                    WHERE ID = '$patient_id'";

    if (mysqli_query($con, $sqlVitals) && mysqli_query($con, $sqlDiag) && mysqli_query($con, $sqlCounsel) && mysqli_query($con, $sqlUpdate)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
}
