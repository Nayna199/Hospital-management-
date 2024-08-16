<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';


$fetch_tests_query = "SELECT * FROM tests";
$result_tests = $conn->query($fetch_tests_query);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $selected_tests = isset($_POST['selected_tests']) ? implode(', ', $_POST['selected_tests']) : '';
    $profile_image = $_FILES['profile_image']['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $city = $_POST['city'];

    
    $total_price = 0;
    if (!empty($selected_tests)) {
        $selected_tests_array = explode(', ', $selected_tests);
        foreach ($selected_tests_array as $test_name) {
            $fetch_price_query = "SELECT price FROM tests WHERE test_name = '$test_name'";
            $result_price = $conn->query($fetch_price_query);
            if ($result_price && $row = $result_price->fetch_assoc()) {
                $total_price += $row['price'];
            }
        }
    }

    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    
    if ($_FILES["profile_image"]["size"] > 5000000) { 
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

   
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profile_image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    
    $insert_query = "INSERT INTO patients (first_name, last_name, email, phone_number, gender, 
                        tests, profile_image, date_of_birth, city, price) 
                        VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$gender', 
                        '$selected_tests', '$profile_image', '$date_of_birth', '$city', $total_price)";

    if ($conn->query($insert_query) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error adding record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient Record</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    

    <style>
    body {
        font-family: 'Helvetica', sans-serif;
        margin: 0;
        padding: 0;
        background-color: plum;
        background: url('myhoss.png') no-repeat center center fixed;
        background-size: cover;
    }

    h2 {
        color: purple;
        text-align: center;
        margin-top: 30px;
        font-size: 14px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: center;
    }

    ul a {
        color: purple;
        text-decoration: none;
    }

    ul li {
        display: inline;
        margin-right: 15px;
    }

    form {
        width: 60%;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form label {
        display: block;
        margin-top: 10px;
        color: purple;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="file"],
    form input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        box-sizing: border-box;
    }

    form input[type="radio"] {
        margin-top: 5px;
        margin-right: 5px;
    }

    form select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        box-sizing: border-box;
    }

    form img#imagePreview {
        max-width: 200px;
        max-height: 200px;
        display: block;
        margin-top: 10px;
    }

    form input[type="submit"] {
        background-color: purple;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    #totalPrice {
        color: purple;
    }
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: center;
    }

    ul a {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px;
        text-decoration: none;
        color: white;
        background-color: purple;
        border-radius: 5px;
        font-family: 'Helvetica', sans-serif;
        font-size: 10px;
        transition: background-color 0.3s;
    }

    ul a:hover {
        background-color: plum;
        color: white;
    }

    a {
        color: purple;
    }
</style>

</head>
<body>
    <h2>Add Patient Record</h2>

    
    <ul>
    <li><a href="index.php">ALL RECORDS 🎈</a></li>
        <li><a href="add_patient.php">ADD NEW PATIENT ♥</a></li>
        <li><a href="add_test.php">ADD TESTS 📝</a></li>
        <li><a href="list_tests.php">TEST LIST 🔍</a></li>
        <li><a href="logout.php">LOG OUT ⌛</a></li>
    </ul>

    <form method="POST" action="" id="addPatientForm" enctype="multipart/form-data">
        
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other<br>

        <label for="selected_tests">Selected Tests:</label>
        <select name="selected_tests[]" multiple required>
            <?php
            while ($row = $result_tests->fetch_assoc()) {
                echo "<option value='{$row['test_name']}'>{$row['test_name']}</option>";
            }
            ?>
        </select><br>

        <label for="profile_image">Profile Image:</label>
        <input type="file" name="profile_image" accept="image/*" required><br>
        <img id="imagePreview" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;"><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" required><br>

        <label for="city">City:</label>
        <input type="text" name="city" required><br>

       
        <label for="price">Total Price:</label>
        <span id="totalPrice">0.00</span><br>

        <input type="submit" value="Add Record">
    </form>

    <script>
       
       $('select[name="selected_tests"]').change(function () {
            var total = 0;
            $('#selectedTests option:selected').each(function () {
                var test_name = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'get_test_price.php', 
                    data: { test_name: test_name },
                    async: false,
                    success: function (data) {
                        total += parseFloat(data);
                    }
                });
            });
            $('#totalPrice').text(total.toFixed(2));
        });

       
        function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result);
            $('#imagePreview').css('display', 'block');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

        $('input[name="profile_image"]').change(function () {
            readURL(this);
        });
    </script>
</body>
</html>
