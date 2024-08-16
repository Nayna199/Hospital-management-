<?php
include 'db.php';


$records_per_page = 10;


$total_records_query = "SELECT COUNT(*) AS total_records FROM patients";
$total_records_result = $conn->query($total_records_query);

if ($total_records_result === false) {
    die("Error fetching total records: " . $conn->error);
}

$total_records = $total_records_result->fetch_assoc()['total_records'];


$total_pages = ceil($total_records / $records_per_page);


$pagination_data = array(
    'total_pages' => $total_pages
);

header('Content-Type: application/json');
echo json_encode($pagination_data);
?>
