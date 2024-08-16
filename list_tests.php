<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$select_tests_query = "SELECT * FROM tests";
$result_tests = $conn->query($select_tests_query);

if (!$result_tests) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Test Records</title>
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
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        ul a {
            color: brown;
            text-decoration: none;
        }

        ul li {
            display: inline;
            margin-right: 15px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px purple;
        }

        th {
            background-color: purple;
            color: white;
        }

        tbody tr:hover {
            background-color: plum; 
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: purple;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
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
    <h2>Test's Records lists </h2>

   
    <ul>
    <li><a href="index.php">ALL RECORDS 🎈</a></li>
        <li><a href="add_patient.php">ADD NEW PATIENT ♥</a></li>
        <li><a href="add_test.php">ADD TESTS 📝</a></li>
        <li><a href="list_tests.php">TEST LIST 🔍</a></li>
        <li><a href="logout.php">LOG OUT ⌛</a></li>
    </ul>
   
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Test Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result_tests->num_rows > 0) {
            while ($row_test = $result_tests->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_test['id'] . "</td>";
                echo "<td>" . $row_test['test_name'] . "</td>";
                echo "<td>" . $row_test['price'] . "</td>";

                $test_id = isset($row_test['id']) ? $row_test['id'] : null;
                echo "<td><a href='add_test.php?test_id=" . $test_id . "'>Edit</a> | " .
                     "<a href='delete_test.php?test_id=" . $test_id . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>

   
    <p><a href="add_test.php">Add New Test Record</a></p>
</body>
</html>
