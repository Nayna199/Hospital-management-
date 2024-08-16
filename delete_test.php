<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['test_id']) && !empty($_GET['test_id'])) {
   
    $test_id = intval($_GET['test_id']);

    
    $delete_test_query = $conn->prepare("DELETE FROM tests WHERE id = ?");
    $delete_test_query->bind_param("i", $test_id);

    if ($delete_test_query->execute()) {
       
        $delete_test_query->close();
        $conn->close();
       
        header("Location: list_tests.php");
        exit();
    } else {
       
        $delete_test_query->close();
        $conn->close();
        echo "Error deleting test: " . $conn->error;
    }
} else {
   
    header("Location: list_tests.php");
    exit();
}
?>