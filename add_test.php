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


$test_name = "";
$price = "";
$test_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test_name = $_POST['test_name'];
    $price = $_POST['price'];

    if (isset($_POST['test_id']) && !empty($_POST['test_id'])) {
        $test_id = $_POST['test_id'];
        $update_query = "UPDATE tests SET test_name = ?, price = ? WHERE id = ?";

        $update_statement = $conn->prepare($update_query);
        $update_statement->bind_param("sdi", $test_name, $price, $test_id);

        if ($update_statement->execute()) {
            header("Location: list_tests.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        $insert_query = "INSERT INTO tests (test_name, price) VALUES (?, ?)";

        $insert_statement = $conn->prepare($insert_query);
        $insert_statement->bind_param("sd", $test_name, $price);

        if ($insert_statement->execute()) {
            header("Location: list_tests.php");
            exit();
        } else {
            echo "Error adding record: " . $conn->error;
        }
    }
}


if (isset($_GET['test_id'])) {
    $test_id = $_GET['test_id'];

    $select_test_query = "SELECT * FROM tests WHERE id = ?";
    $select_statement = $conn->prepare($select_test_query);
    $select_statement->bind_param("i", $test_id);

    if ($select_statement->execute()) {
        $result_test = $select_statement->get_result();

        if ($result_test->num_rows == 1) {
            $row_test = $result_test->fetch_assoc();
            $test_name = $row_test['test_name'];
            $price = $row_test['price'];
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Test Record</title>

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
            color:purple;
            text-align: center;
            margin-top: 30px;
            
            
            
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
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: purple;
            color: white;
            font-size: 12px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
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
        color: brown;
    }
    </style>
</head>
<body>
    <h2>Add Test Record</h2>


    <ul>
    <li><a href="index.php">ALL RECORDS 🎈</a></li>
        <li><a href="add_patient.php">ADD NEW PATIENT ♥</a></li>
        <li><a href="add_test.php">ADD TESTS 📝</a></li>
        <li><a href="list_tests.php">TEST LIST 🔍</a></li>
        <li><a href="logout.php">LOG OUT ⌛</a></li>
    </ul>

    <form method="POST" action="">
       
        <label for="test_name">Test Name:</label>
        <input type="text" name="test_name" value="<?php echo isset($row_test['test_name']) ? $row_test['test_name'] : ''; ?>" required><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo isset($row_test['price']) ? $row_test['price'] : ''; ?>" required><br>

       
        <?php
        if (isset($row_test['test_id'])) {
            echo "<input type='hidden' name='test_id' value='" . $row_test['test_id'] . "'>";
        }
        ?>

        <input type="submit" value="Add Test  ✔">
    </form>
</body>
</html>
