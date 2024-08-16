<?php
include 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $patient_id = $_GET['id'];

   
    $fetch_patient_query = "SELECT * FROM patients WHERE id = $patient_id";
    $result = $conn->query($fetch_patient_query);

    if ($result === false) {
        die("Error in query: " . $conn->error);
    }

    
    if ($result->num_rows > 0) {
        
        $patient = $result->fetch_assoc();

       
        include 'edit_patient_form.php';
    } else {
        echo "Patient record not found";
    }
} else {
    echo "Invalid patient ID";
}
?>
