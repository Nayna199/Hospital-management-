<?php
include 'db.php';


$records_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start_from = ($page - 1) * $records_per_page;


$fetch_patients_query = "SELECT * FROM patients LIMIT $start_from, $records_per_page";
$result_patients = $conn->query($fetch_patients_query);

if ($result_patients === false) {
    die("Error fetching patients: " . $conn->error);
}

$patients_data = array();

while ($row = $result_patients->fetch_assoc()) {
    $patients_data[] = $row;
}


header('Content-Type: application/json');
echo json_encode($patients_data);
?>
