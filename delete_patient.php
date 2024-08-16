<?php
session_start();

include 'db.php';

$response = array();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $patient_id = $_GET['id'];

    $delete_patient_query = "DELETE FROM patients WHERE id = $patient_id";
    $result = $conn->query($delete_patient_query);

    if ($result === TRUE) {
        $response['success'] = true;
        $response['message'] = "Patient deleted successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error deleting patient: " . $conn->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid patient ID";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
