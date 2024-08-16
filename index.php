<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<style>
body {
    background-color: plum;
    font-family: 'Helvetica', sans-serif;
    margin: 0;
    padding: 0;
    background: url('myhoss.png') no-repeat center center fixed;
    background-size: contain;
}

.container {
    width: 70%;
    margin: 0 auto;
    padding: 45px;
    border-radius: 8px;
}

h1 {
    color: purple;
    text-align: center;
    margin-top: 20px;
}

.menu {
    text-align: center;
    margin-top: 30px;
}

.menu a {
    display: inline-block;
    padding: 8px 20px;
    margin: 0 10px;
    text-decoration: none;
    color: white;
    background-color: purple;
    border-radius: 5px;
    font-family: 'Helvetica', sans-serif;
    font-size: 10px;
    transition: background-color 0.3s;
}

.menu a:hover {
    background-color: plum;
    color: papayawhip; 
}

.menu a:first-child {
    margin-left: 0;
}

.menu a:last-child {
    margin-right: 0;
}


table {
    width: center;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 7px;
    overflow: hidden;
}

th, td {
    padding: 12px;
    text-align: inline;
    border-bottom: 1px purple;
}

th {
    background-color: purple;
    color: white;
    font-size: 10px;
}

tbody tr:hover {
    background-color: plum; 
}

.pagination {
    list-style: none;
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination li {
    margin: 0 5px;
}

.pagination a {
    color: white;
    text-decoration: none;
    padding: 8px 12px;
    border: 1px purple;
    border-radius: 4px;
}

.pagination a:hover {
    background-color: plum;
    color: white;
}

</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Patient Records</title>
    
</head>

<body>

    <div class="container">
        <h1> MY PATIENTS RECORDS💕</h1>

        <div class="menu">
        <a href="index.php"> ALL RECORDS 🎈</a>
            <a href="add_patient.php">ADD NEW PATIENT ♥</a>
            <a href="add_test.php">ADD TEST 📝 </a>
            <a href="list_tests.php">TEST LIST 🔍</a>
            <a href="logout.php">LOG OUT ⌛</a>

            

        </div>
       
    

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Gender</th>
                    <th>Selected Tests</th>
                    <th>Profile Image</th>
                    <th>DOB</th>
                    <th>City</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="patientTableBody">
                
              
            </tbody>
        </table>

       
        <ul class="pagination" id="pagination"></ul>

      
    </div>

   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  
    <script src="ajax.js"></script>

</body>

</html>
