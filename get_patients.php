<?php
include 'db.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10; 

$offset = ($page - 1) * $limit;

$fetch_patients_query = "SELECT * FROM patients LIMIT $offset, $limit";
$result_patients = $conn->query($fetch_patients_query);

$patients = array();

while ($row = $result_patients->fetch_assoc()) {
    $patients[] = $row;
}

echo json_encode($patients);
?>
