<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $tests = $_POST['selected_tests']; 
    $date_of_birth = $_POST['date_of_birth'];
    $city = $_POST['city'];
    $price = $_POST['price'];

  
    $profile_image = $_FILES['profile_image']['name'];
    $temp_image = $_FILES['profile_image']['tmp_name'];
    $image_folder = "uploads/"; 

   
    move_uploaded_file($temp_image, $image_folder . $profile_image);

    
    $update_patient_query = "UPDATE patients SET 
                             first_name = '$first_name', 
                             last_name = '$last_name',
                             email = '$email',
                             phone_number = '$phone_number',
                             gender = '$gender',
                             tests = '$tests',
                             profile_image = '$image_folder$profile_image',
                             date_of_birth = '$date_of_birth',
                             city = '$city',
                             price = '$price'
                             WHERE id = $patient_id";

    $result = $conn->query($update_patient_query);

    if ($result === false) {
        die("Error updating patient: " . $conn->error);
    }

   
    header("Location: index.php");
    exit();
} else {
    echo "Invalid request";
}
?>
