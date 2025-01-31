<?php
require_once '../db/dbconn.php';

$query = "
    SELECT 
        COUNT(*) AS total_patients,
        SUM(CASE WHEN status = 'On-Going' THEN 1 ELSE 0 END) AS total_patients_ongoing,
        SUM(CASE WHEN status = 'Done' THEN 1 ELSE 0 END) AS total_patients_done,
        SUM(CASE WHEN services = 'Medical Adult' THEN 1 ELSE 0 END) AS total_patients_adult,
        SUM(CASE WHEN services = 'Medical Pedia' THEN 1 ELSE 0 END) AS total_patients_pedia,
        SUM(CASE WHEN services = 'Physical Therapy' THEN 1 ELSE 0 END) AS total_patients_PT,
        SUM(CASE WHEN services = 'Pre-Natal' THEN 1 ELSE 0 END) AS total_patients_PN,
        SUM(CASE WHEN services = 'Dental Extraction' THEN 1 ELSE 0 END) AS total_patients_dental,
        SUM(CASE WHEN services = 'Eye-Screening' THEN 1 ELSE 0 END) AS total_patients_ES,
        SUM(CASE WHEN services = 'Dermatology' THEN 1 ELSE 0 END) AS total_patients_DERM,
        SUM(CASE WHEN services = 'Pap-Smear' THEN 1 ELSE 0 END) AS total_patients_PS
    FROM patients;
";

$result = $con->query($query);
if (!$result) {
    die(json_encode(["error" => "Patients Query failed: " . $con->error]));
}
$patients_data = $result->fetch_assoc();

$query2 = "
    SELECT 
        SUM(CASE WHEN salvation_status = 'on' THEN 1 ELSE 0 END) AS total_patients_saved,
        SUM(CASE WHEN baptism_status = 'on' THEN 1 ELSE 0 END) AS total_patients_baptism,
        SUM(CASE WHEN prayer_status = 'on' THEN 1 ELSE 0 END) AS total_patients_pray,
        SUM(CASE WHEN assurance_status = 'on' THEN 1 ELSE 0 END) AS total_patients_assured
    FROM counselor_records;
";

$result2 = $con->query($query2);
if (!$result2) {
    die(json_encode(["error" => "Counselor Query failed: " . $con->error]));
}
$counselor_data = $result2->fetch_assoc();

echo json_encode(array_merge($patients_data, $counselor_data));

$con->close();
