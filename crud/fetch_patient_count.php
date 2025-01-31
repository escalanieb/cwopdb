<?php
require_once '../db/dbconn.php';

///Fetch Overall Count
$query = "SELECT COUNT(*) as total FROM patients";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients = $row['total'];

//Fetch Overall Count of Patients On-Going Status
$query = "SELECT COUNT(*) as total FROM patients WHERE status = 'On-Going'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_ongoing = $row['total'];

//Fetch Overall Count of Patients Done
$query = "SELECT COUNT(*) as total FROM patients WHERE status = 'Done'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_done = $row['total'];

//Services Count
//Fetch Overall Count of Patients Medical - Adult
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Medical Adult'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_adult = $row['total'];

//Fetch Overall Count of Medical - Pedia
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Medical Pedia'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_pedia = $row['total'];

//Fetch Overall Count of Physical Therapy
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Physical Therapy'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_PT = $row['total'];

//Fetch Overall Count of Pre-Natal Check Up
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Pre-Natal'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_PN = $row['total'];

//Fetch Overall Count of Dental Extraction
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Dental Extraction'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_dental = $row['total'];

//Fetch Overall Count of Eye Screening
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Eye-Screening'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_ES = $row['total'];

//Fetch Overall Count of Dermatology
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Dermatology'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_DERM = $row['total'];

//Fetch Overall Count of Pap-Smear
$query = "SELECT COUNT(*) as total FROM patients WHERE services = 'Pap-Smear'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_PS = $row['total'];

//Counselling
//Fetch Overall Count of Salvation
$query = "SELECT COUNT(*) as total FROM counselor_records WHERE salvation_status = 'on'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_saved = $row['total'];

//Fetch Overall Count of Baptism
$query = "SELECT COUNT(*) as total FROM counselor_records WHERE baptism_status = 'on'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_baptism = $row['total'];

//Fetch Overall Count of Prayer
$query = "SELECT COUNT(*) as total FROM counselor_records WHERE prayer_status = 'on'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_pray = $row['total'];

//Fetch Overall Count of Assurance
$query = "SELECT COUNT(*) as total FROM counselor_records WHERE assurance_status = 'on'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$total_patients_assured = $row['total'];

echo json_encode([
    "total_patients" => $total_patients,
    "total_patients_ongoing" => $total_patients_ongoing,
    "total_patients_done" => $total_patients_done,
    "total_patients_adult" => $total_patients_adult,
    "total_patients_pedia" => $total_patients_pedia,
    "total_patients_PT" => $total_patients_PT,
    "total_patients_PN" => $total_patients_PN,
    "total_patients_dental" => $total_patients_dental,
    "total_patients_ES" => $total_patients_ES,
    "total_patients_DERM" => $total_patients_DERM,
    "total_patients_PS" => $total_patients_PS,
    "total_patients_saved" => $total_patients_saved,
    "total_patients_baptism" => $total_patients_baptism,
    "total_patients_pray" => $total_patients_pray,
    "total_patients_assured" => $total_patients_assured
]);

$con->close();
